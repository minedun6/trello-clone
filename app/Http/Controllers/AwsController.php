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
        return $this->awsService->awsSign(request());
    }
}
