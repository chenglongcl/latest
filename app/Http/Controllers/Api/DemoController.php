<?php

namespace App\Http\Controllers\Api;


use App\Services\DemoService;
use GuzzleHttp\Client;


class DemoController extends Controller
{
    private $demoService;
    private $httpClient;

    public function __construct(DemoService $demoService, Client $client)
    {
        $this->demoService = $demoService;
        $this->httpClient = $client;
    }

    public function demoOne()
    {

        $num = $this->demoService->DemoOne();
        $result = [
            'test_count' => $num
        ];
        return $this->responseDataSimple($result);
    }

    public function demoTwo()
    {
        $url = 'https://www.baidu.com';
        $response = $this->httpClient->get($url);
        $code = $response->getStatusCode();
        $contentType = $response->getHeader("Content-Type");
        return $this->responseDataSimple([
            'code' => $code,
            'contentType' => $contentType
        ]);
    }
}
