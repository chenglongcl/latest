<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
], function ($api) {
    // user detail
    $api->get('users/{id}', [
        'as' => 'users.show',
        'uses' => 'UserController@show',
    ]);

    // User register
    $api->post('users', [
        'as' => 'users.store',
        'uses' => 'UserController@store',
    ]);

    //User login
    $api->post('authorizations', [
        'as' => 'authorizations.store',
        'uses' => 'AuthorizationController@store',
    ]);

    //Refresh token
    $api->put('authorizations/current', [
        'as' => 'authorizations.update',
        'uses' => 'AuthorizationController@update'
    ]);

    // POST
    // post list
    $api->get('posts/{cid?}', [
        'as' => 'api.posts.index',
        'uses' => 'PostController@index',
    ]);
    // post detail
    $api->get('posts/show/{id}', [
        'as' => 'api.posts.show',
        'uses' => 'PostController@show',
    ]);

    $api->group(['middleware' => 'api.auth'], function ($api) {
        //获取当前用户信息
        $api->get('user', [
            'as' => 'api.user.show',
            'uses' => 'UserController@userShow'
        ]);
        //修改用户信息
        $api->patch('user', [
            'as' => 'api.user.update',
            'uses' => 'UserController@patch',
        ]);
        //图片资源路由
        $api->resource('uploadpic', 'UploadPicController');
        //用户发布文章
        $api->post('posts', [
            'as' => 'api.posts.store',
            'uses' => 'PostController@store',
        ]);
    });
});


$api->version('admin_v1', [
    'namespace' => 'App\Http\Controllers\Admin',
    'middleware' => ['jwt.user.toAdmin']
], function ($api) {
    // Admin register
    $api->post('admin', [
        'as' => 'admin.store',
        'uses' => 'AdminController@store',
    ]);
    //Admin login
    $api->post('authorizations', [
        'as' => 'admin.authorizations.store',
        'uses' => 'AuthorizationController@store',
    ]);

    $api->group(['middleware' => ['api.auth', 'auth.admin']], function ($api) {
        //获取当前管理员信息
        $api->get('admin', [
            'as' => 'api.admin.show',
            'uses' => 'AdminController@adminShow'
        ]);
    });
});