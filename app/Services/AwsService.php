<?php

namespace App\Services;

use Aws\S3\S3Client;
use Aws\Credentials\Credentials;

class AwsService
{
    private $clientPrivateKey;
    private $serverPublicKey;
    private $serverPrivateKey;
    private $expectedBucketName;
    private $expectedHostName; // v4-only
    private $expectedMaxSize;
    private $expectedBucketRegion;
    private $expectedBucketVersion;
    private $request;

    /**
     * Construct all the configs
     *
     * -the code below require your to set the environments under config/services.php
     * please see service.php for example, you can also direct set the environment
     * here for quick test
     */
    public function __construct()
    {
        $this->clientPrivateKey = config('services.amazon.clientPrivateKey');
        $this->serverPublicKey = config('services.amazon.serverPublicKey');
        $this->serverPrivateKey = config('services.amazon.serverPrivateKey');
        $this->expectedBucketName = config('services.amazon.expectedBucketName');
        $this->expectedHostName = config('services.amazon.expectedHostName');
        $this->expectedMaxSize = config('services.amazon.expectedMaxSize');
        $this->expectedBucketRegion = config('services.amazon.expectedBucketRegion');
        $this->expectedBucketVersion = config('services.amazon.expectedBucketVersion');
        $this->request = request();
    }

    private function getS3Client()
    {
        $credentials = new Credentials($this->serverPublicKey, $this->serverPrivateKey);
        return new S3Client([
            'region' => $this->expectedBucketRegion,
            'version' => $this->expectedBucketVersion,
            'credentials' => $credentials
        ]);
    }

    public function signRequest()
    {
        $content = $this->request->getContent();
        $contentAsObject = json_decode($content, true);
        $jsonContent = json_encode($contentAsObject);
        if (isset($contentAsObject["headers"])) {
            return $this->signRestRequest($contentAsObject["headers"]);
        } else {
            return $this->signPolicy($jsonContent);
        }
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
            return response()->json($response);
        } else {
            return response()->json(['invalid' => true]);
        }
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
        $dateKey = hash_hmac('sha256', $matches[1], 'AWS4' . $this->clientPrivateKey, true);
        $dateRegionKey = hash_hmac('sha256', $matches[2], $dateKey, true);
        $dateRegionServiceKey = hash_hmac('sha256', 's3', $dateRegionKey, true);
        $signingKey = hash_hmac('sha256', 'aws4_request', $dateRegionServiceKey, true);
        return hash_hmac('sha256', $stringToSign, $signingKey);
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
        return $bucket == $this->expectedBucketName && $parsedMaxSize == (string)$this->expectedMaxSize;
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
            return response()->json($response);
        } else {
            return response()->json(['invalid' => true]);
        }
    }

    private function sign($stringToSign)
    {
        return base64_encode(hash_hmac(
            'sha1',
            $stringToSign,
            $this->clientPrivateKey,
            true
        ));
    }

    private function signV4RestRequest($rawStringToSign)
    {
        $pattern = "/.+\\n.+\\n(\\d+)\/(.+)\/s3\/aws4_request\\n(.+)/s";
        preg_match($pattern, $rawStringToSign, $matches);
        $hashedCanonicalRequest = hash('sha256', $matches[3]);
        $stringToSign = preg_replace("/^(.+)\/s3\/aws4_request\\n.+$/s", '$1/s3/aws4_request' . "\n" . $hashedCanonicalRequest, $rawStringToSign);
        $dateKey = hash_hmac('sha256', $matches[1], 'AWS4' . $this->clientPrivateKey, true);
        $dateRegionKey = hash_hmac('sha256', $matches[2], $dateKey, true);
        $dateRegionServiceKey = hash_hmac('sha256', 's3', $dateRegionKey, true);
        $signingKey = hash_hmac('sha256', 'aws4_request', $dateRegionServiceKey, true);
        return hash_hmac('sha256', $stringToSign, $signingKey);
    }

    private function isValidRestRequest($headersStr, $version)
    {
        if ($version == 2) {
            $expectedBucketName = $this->expectedBucketName;
            $pattern = "/\/$expectedBucketName\/.+$/";
        } else {
            $expectedHostName = $this->expectedHostName;
            $pattern = "/host:$expectedHostName/";
        }
        preg_match($pattern, $headersStr, $matches);
        return count($matches) > 0;
    }

    private function getObjectSize($bucket, $key)
    {
        $objInfo = $this->getS3Client()->headObject([
            'Bucket' => $bucket,
            'Key' => $key
        ]);
        return $objInfo['ContentLength'];
    }

    // Provide a time-bombed public link to the file.
    private function getTempLink($bucket, $key)
    {
        $client = $this->getS3Client();
        $url = "{$bucket}/{$key}";
        $cmd = $client->getCommand('GetObject', [
            'Bucket' => $bucket,
            'Key' => $key
        ]);
        $request = $client->createPresignedRequest($cmd, '+15 minutes');
        return (string)$request->getUri();
    }

    // Only needed if the delete file feature is enabled
    private function deleteObject()
    {
        $this->getS3Client()->deleteObject([
            'Bucket' => $this->request->bucket,
            'Key' => $this->request->key
        ]);
    }

    // This is not needed if you don't require a callback on upload success.
    public function verifyFileInS3($includeThumbnail)
    {
        $bucket = $this->request->bucket;
        $key = $this->request->key;
        if (isset($this->expectedMaxSize) && $this->getObjectSize($bucket, $key) > $this->expectedMaxSize) {
            $this->deleteObject();
            return response()->json(["error" => "File is too big!", "preventRetry" => true], 500);
        } else {
            $link = $this->getTempLink($bucket, $key);
            $response = ["tempLink" => $link];
            if ($includeThumbnail) {
                $response["thumbnailUrl"] = $link;
            }
            return response()->json($response);
        }
    }

    // Return true if it's likely that the associate file is natively
    // viewable in a browser.  For simplicity, just uses the file extension
    // to make this determination, along with an array of extensions that one
    // would expect all supported browsers are able to render natively.
    protected function isFileViewableImage($filename)
    {
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $viewableExtensions = array("jpeg", "jpg", "gif", "png", "svg");
        return in_array($ext, $viewableExtensions);
    }

    // Returns true if we should attempt to include a link
    // to a thumbnail in the uploadSuccess response.  In it's simplest form
    // (which is our goal here - keep it simple) we only include a link to
    // a viewable image and only if the browser is not capable of generating a client-side preview.
    public function shouldIncludeThumbnail()
    {
        $filename = $this->request->name;
        $isPreviewCapable = $this->request->isBrowserPreviewCapable == "true";
        $isFileViewableImage = $this->isFileViewableImage($filename);
        return !$isPreviewCapable && $isFileViewableImage;
    }
}