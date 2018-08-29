<?php

namespace App\Util\Response;

use League\Fractal\Serializer\ArraySerializer;

class CustomSerializer extends ArraySerializer
{
    private $code;

    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * 重新封装Dingo API返回的data，加入code和message
     *
     * @param string $resourceKey
     * @param array $data
     * @return array
     */
    public function collection($resourceKey, array $data)
    {
        return [
            'message' => '操作成功',
            'code' => $this->code,
            'data' => $data
        ];
    }

    public function item($resourceKey, array $data)
    {
        return [
            'message' => '操作成功',
            'data' => $data,
            'code' => $this->code
        ];
    }
}