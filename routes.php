<?php
use RainLab\User\Models\User as UserModel;
use Blskye\Curdtools\Classes\JsonResponseBuilder;
/**
 * Get Test
 */
Route::get('api/test', function (){
   return Response::json(['id'=>'1']);
});


/**
 * Get Test
 */
Route::get('api/test/user', function (){
    $all=UserModel::get();
    return JsonResponseBuilder::ok($all);
});

/**
 * Error Test
 */
Route::get('api/test/error', function (){
    return Response::json(['error_code'=>'401001','message'=>''],401);
});


