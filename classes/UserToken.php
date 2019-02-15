<?php
/**
 * Created by PhpStorm.
 * User: wanghaotian
 * Date: 2019-02-15
 * Time: 00:28
 */
namespace blskye\curdtools\classes;

use Illuminate\Support\Facades\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class UserToken
{
    public static function getUserFromToken(){
        $userModel = JWTAuth::authenticate(Request::input('token'));//获取用户Model
        return $userModel;
    }
}