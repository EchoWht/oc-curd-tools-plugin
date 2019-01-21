<?php
/**
 * Created by PhpStorm.
 * User: wanghaotian
 * Date: 2019-01-19
 * Time: 17:39
 */

namespace Blskye\Curdtools\Classes;

use Illuminate\Support\Facades\Response;
class JsonResponseBuilder
{
    public function json($data,$status)
    {
        return Response::json($data,$status);
    }

    /**
     * 请求成功
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public  static function ok($data)
    {
        return Response::json($data,200);
    }

    /**
     * 创建成功
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public  static function created($data)
    {
        return Response::json($data,201);
    }

    /**
     * 更新成功
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public  static function accepted($data)
    {
        return Response::json($data,202);
    }

    /**
     * 请求的地址不存在或者包含不支持的参数
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public  static function badRequest($data)
    {
        return Response::json($data,400);
    }

    /**
     * 请求的地址不存在或者包含不支持的参数
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public  static function unauthorized($data)
    {
        return Response::json($data,401);
    }

    /**
     * 被禁止访问
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public  static function forbidden($data)
    {
        return Response::json($data,403);
    }

    /**
     * 请求的资源不存在
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public  static function notFound($data)
    {
        return Response::json($data,404);
    }

    /**
     * 请求的资源不存在
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public  static function internalServerError($data)
    {
        return Response::json($data,500);
    }
}