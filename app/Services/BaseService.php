<?php

namespace App\Services;


use Predis\Client;

class BaseService
{
    protected $redis_client;

    /**
     * BaseService constructor.
     */
    public function __construct()
    {
        $this->redis_client = new Client(
            config('database.redis.default'), ['prefix' => env('REDIS_PREFIX', 'latest:latest_')]
        );
    }
}