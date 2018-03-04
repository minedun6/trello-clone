<?php

namespace App\Http\Controllers;


use App\Services\AwsService;

class AwsController extends Controller
{

    protected $awsService;

    /**
     * AwsController constructor.
     *
     * @param \App\Services\AwsService $awsService
     */
    public function __construct(AwsService $awsService)
    {

        $this->awsService = $awsService;
    }

    //the method your route point to
    public function __invoke()
    {
        if (isset($this->request->success)) {
            //after successful upload
            //the request will contain the bucket and key at this point
            return $this->awsService->verifyFileInS3($this->awsService->shouldIncludeThumbnail());
        } else {
            //sign request handling
            return $this->awsService->signRequest();
        }
    }
}
