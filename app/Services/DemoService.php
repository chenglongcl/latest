<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/4
 * Time: 17:26
 */

namespace App\Services;


class DemoService extends BaseService
{
    public function DemoOne()
    {
        $this->redis_client->incrby("test_count", 1);
        $result = $this->redis_client->get("test_count");
        return $result;
    }
}