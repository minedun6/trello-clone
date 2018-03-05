<?php

namespace App\Services;

use Aws\S3\S3Client;
use Aws\Credentials\Credentials;

class AwsService
{
    private $bucket = '';
    private $expectedHostName = ''; // v4-only
    private $expectedMaxSize = 500000000;
    private $url;
    private $key;
    private $secret;
    private $request;

    public function awsSign($request)
    {
        $this->initService($request);

        $method = $this->request->getMethod();

        // This first conditional will only ever evaluate to true in a
        // CORS environment
        if ($method == 'OPTIONS') {

            $this->handlePreflight();
        }
        // This second conditional will only ever evaluate to true if
        // the delete file feature is enabled
        else if ($method == "DELETE") {

            $this->handleCorsRequest(); // only needed in a CORS environment
            $this->deleteObject();
        }
        // This is all you really need if not using the delete file feature
        // and not working in a CORS environment
        else if ($method == 'POST') {

            $this->handleCorsRequest();

            // Assumes the successEndpoint has a parameter of "success" associated with it,
            // to allow the server to differentiate between a successEndpoint request
            // and other POST requests (all requests are sent to the same endpoint in this example).
            // This condition is not needed if you don't require a callback on upload success.
            if ($this->request->has('success')) {

                $this->verifyFileInS3($this->shouldIncludeThumbnail());
            } else {

                $this->signRequest();
            }
        }
    }

    public function initService($request)
    {
        $this->request = $request;
        $this->url = config('app.url');
        $this->key = config('aws.public_key');
        $this->secret = config('aws.secret_key');
    }

    // Only needed in cross-origin setups
    private function handleCorsRequest()
    {
        // If you are relying on CORS, you will need to adjust the allowed domain here.
        header('Access-Control-Allow-Origin: ' . $this->url);
    }

    // Only needed in cross-origin setups
    private function handlePreflight()
    {
        handleCorsRequest();
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Content-Type');
    }

    private function getS3Client()
    {
        return new S3Client([
            'key' => $this->key,
            'secret' => $this->secret,
            'signature' => 'v4',
            'version' => 'latest'
        ]);
    }

    // Only needed if the delete file feature is enabled
    private function deleteObject()
    {
        $this->getS3Client()->deleteObject([
            'Bucket' => $this->request->bucket,
            'Key' => $this->request->key
        ]);
    }

    private function signRequest()
    {
        header('Content-Type: application/json');

        $responseBody = file_get_contents('php://input');
        $contentAsObject = json_decode($responseBody, true);
        $jsonContent = json_encode($contentAsObject);

        if (!empty($contentAsObject["headers"])) {
            $str_to_sign = $contentAsObject["headers"];
            $request = str_replace(["\r\n", "\n", "\r"], '&', $str_to_sign);
            $this->bucket = $this->get_string_between($request, 'x-amz-target-bucket:', '&');
            $this->signRestRequest($str_to_sign);
        } else {
            $this->bucket = $contentAsObject['conditions'][1]['bucket'];
            $this->signPolicy($jsonContent);
        }
    }

    private function signRestRequest($headersStr)
    {
        $version = $this->request->has('v4') ? 4 : 2;
        if ($this->isValidRestRequest($headersStr, $version)) {
            if ($version == 4) {
                $response = ['signature' => $this->signV4RestRequest($headersStr)];
            } else {
                $response = ['signature' => $this->sign($headersStr)];
            }

            echo json_encode($response);
        } else {
            echo json_encode(["invalid" => true]);
        }
    }

    private function isValidRestRequest($headersStr, $version)
    {
        if ($version == 2) {

            $pattern = "/\/$this->bucket\/.+$/";
        } else {
            $pattern = "/host:$this->expectedHostName/";
        }

        preg_match($pattern, $headersStr, $matches);

        return count($matches) > 0;
    }

    private function signPolicy($policyStr)
    {
        $policyObj = json_decode($policyStr, true);

        if ($this->isPolicyValid($policyObj)) {
            $encodedPolicy = base64_encode($policyStr);
            if ($this->request->has('v4')) {
                $response = ['policy' => $encodedPolicy, 'signature' => $this->signV4Policy($encodedPolicy, $policyObj)];
            } else {
                $response = ['policy' => $encodedPolicy, 'signature' => $this->sign($encodedPolicy)];
            }
            echo json_encode($response);
        } else {
            echo json_encode(["invalid" => true]);
        }
    }

    private function isPolicyValid($policy)
    {
        $conditions = $policy["conditions"];
        $bucket = null;
        $parsedMaxSize = null;

        for ($i = 0; $i < count($conditions); ++$i) {
            $condition = $conditions[$i];

            if (isset($condition["bucket"])) {
                $bucket = $condition["bucket"];
            } else if (isset($condition[0]) && $condition[0] == "content-length-range") {
                $parsedMaxSize = $condition[2];
            }
        }

        return $bucket == $this->bucket && $parsedMaxSize == (string) $this->expectedMaxSize;
    }

    private function sign($stringToSign)
    {
        return base64_encode(hash_hmac(
            'sha1', $stringToSign, $this->secret, true
        ));
    }

    private function signV4Policy($stringToSign, $policyObj)
    {
        foreach ($policyObj["conditions"] as $condition) {
            if (isset($condition["x-amz-credential"])) {
                $credentialCondition = $condition["x-amz-credential"];
            }
        }

        $pattern = "/.+\/(.+)\\/(.+)\/s3\/aws4_request/";
        preg_match($pattern, $credentialCondition, $matches);

        $dateKey = hash_hmac('sha256', $matches[1], 'AWS4' . $this->secret, true);
        $dateRegionKey = hash_hmac('sha256', $matches[2], $dateKey, true);
        $dateRegionServiceKey = hash_hmac('sha256', 's3', $dateRegionKey, true);
        $signingKey = hash_hmac('sha256', 'aws4_request', $dateRegionServiceKey, true);

        return hash_hmac('sha256', $stringToSign, $signingKey);
    }

    private function signV4RestRequest($rawStringToSign)
    {
        $pattern = "/.+\\n.+\\n(\\d+)\/(.+)\/s3\/aws4_request\\n(.+)/s";
        preg_match($pattern, $rawStringToSign, $matches);

        $hashedCanonicalRequest = hash('sha256', $matches[3]);
        $stringToSign = preg_replace("/^(.+)\/s3\/aws4_request\\n.+$/s", '$1/s3/aws4_request' . "\n" . $hashedCanonicalRequest, $rawStringToSign);

        $dateKey = hash_hmac('sha256', $matches[1], 'AWS4' . $this->secret, true);
        $dateRegionKey = hash_hmac('sha256', $matches[2], $dateKey, true);
        $dateRegionServiceKey = hash_hmac('sha256', 's3', $dateRegionKey, true);
        $signingKey = hash_hmac('sha256', 'aws4_request', $dateRegionServiceKey, true);

        return hash_hmac('sha256', $stringToSign, $signingKey);
    }

    // This is not needed if you don't require a callback on upload success.
    private function verifyFileInS3($includeThumbnail)
    {
        $bucket = $this->request->bucket;
        $key = $this->request->key;

        // If utilizing CORS, we return a 200 response with the error message in the body
        // to ensure Fine Uploader can parse the error message in IE9 and IE8,
        // since XDomainRequest is used on those browsers for CORS requests.  XDomainRequest
        // does not allow access to the response body for non-success responses.
        if (isset($this->expectedMaxSize) && $this->getObjectSize($bucket, $key) > $this->expectedMaxSize) {
            // You can safely uncomment this next line if you are not depending on CORS
            header("HTTP/1.0 500 Internal Server Error");
            $this->deleteObject();
            echo json_encode(["error" => "File is too big!", "preventRetry" => true]);
        } else {
            $link = $this->getTempLink($bucket, $key);
            $response = ["tempLink" => $link];

            if ($includeThumbnail) {
                $response["thumbnailUrl"] = $link;
            }

            echo json_encode($response);
        }
    }

    // Provide a time-bombed public link to the file.
    private function getTempLink($bucket, $key)
    {
        $client = $this->getS3Client();
        $url = "{$bucket}/{$key}";
        $request = $client->get($url);

        return $client->createPresignedUrl($request, '+15 minutes');
    }

    private function getObjectSize($bucket, $key)
    {
        $objInfo = $this->getS3Client()->headObject([
            'Bucket' => $bucket,
            'Key' => $key
        ]);
        return $objInfo['ContentLength'];
    }

    // Return true if it's likely that the associate file is natively
    // viewable in a browser.  For simplicity, just uses the file extension
    // to make this determination, along with an array of extensions that one
    // would expect all supported browsers are able to render natively.
    private function isFileViewableImage($filename)
    {
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $viewableExtensions = ["jpeg", "jpg", "gif", "png"];

        return in_array($ext, $viewableExtensions);
    }

    // Returns true if we should attempt to include a link
    // to a thumbnail in the uploadSuccess response.  In it's simplest form
    // (which is our goal here - keep it simple) we only include a link to
    // a viewable image and only if the browser is not capable of generating a client-side preview.
    private function shouldIncludeThumbnail()
    {
        $filename = $this->request->name;
        $isPreviewCapable = $this->request->isBrowserPreviewCapable == "true";
        $isFileViewableImage = $this->isFileViewableImage($filename);

        return !$isPreviewCapable && $isFileViewableImage;
    }

    private function get_string_between($string, $start, $end)
    {
        $ini = strpos($string, $start);
        if ($ini == 0)
            return "";
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
}