<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/29
 * Time: 10:26
 */

namespace App\Util\Response;


use Dingo\Api\Routing\Helpers;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;
use League\Fractal\Manager;
use League\Fractal\TransformerAbstract;

trait  Responder
{
    use Helpers;

    public function responseItem($item, TransformerAbstract $transformer, $code = 0)
    {
        return $this->response->item($item, $transformer, [], function ($resource, Manager $fractal) use ($code) {
            $fractal->setSerializer(new CustomSerializer($code));
        });
    }

    public function responseCollection(Collection $collection, TransformerAbstract $transformer, $code = 0)
    {
        return $this->response->collection($collection, $transformer, [],
            function ($resource, Manager $fractal) use ($code) {
                $fractal->setSerializer(new CustomSerializer($code));
            });
    }

    public function responsePaginate(Paginator $paginator, TransformerAbstract $transformer, $code = 0)
    {
        return $this->response->paginator($paginator, $transformer, [], function ($resource, Manager $fractal) use ($code) {
            $fractal->setSerializer(new CustomSerializer($code));
        });
    }

    public function responseData(array $data, $code)
    {
        return Response::json([
            'message' => '操作成功',
            'code' => $code,
            'data' => $data
        ], 200);
    }

    public function responseSuccess($message = '操作成功', $code)
    {
        return Response::json([
            'message' => $message,
            'code' => $code,
        ], 200);
    }

    public function responseFailed($message = '操作失败', $code)
    {
        return Response::json([
            'message' => $message,
            'code' => $code,
        ], 422);
    }

    public function responseError($message = '未知错误', $code)
    {
        return Response::json([
            'message' => $message,
            'code' => $code,
        ], 500);
    }
}