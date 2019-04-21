<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['namespace' => 'Api'], function() use ($router)
{
    // 使用 "App\Http\Controllers\Api" 命名空间...

    //允许跨域访问
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header('Access-Control-Allow-Credentials: true');
    header("Access-Control-Allow-Headers: Authorization,Content-Type,token");
	header('Access-Control-Max-Age:3600');

    $router->post('login', 'LoginController@login');
    $router->post('upload', 'UploadController@index');
    $router->post('uploadbase64', 'UploadController@uploadbase64');
    $router->get('article/list', 'ArticleController@list');
    $router->get('article/detail', 'ArticleController@detail');
    $router->post('article/create', 'ArticleController@create');
    $router->post('article/update', 'ArticleController@update');
    $router->get('user/search', 'UserController@search');
    $router->get('type/select', 'TypeController@select');

    $router->group(['middleware'=>'token'],function() use ($router){
        $router->get('user/index', 'UserController@index');
        $router->get('user/avatar', 'UserController@saveavatar');
        $router->get('user/test', 'UserController@test');
        $router->get('user/loginlog', 'UserController@loginlog');
        $router->get('message', 'MessageController@index');

        //标签查询，创建，修改的功能
        $router->get('label/index', 'LabelController@index');
        $router->post('label/create', 'LabelController@create');
        $router->post('label/update', 'LabelController@update');


    });


});


$router->group(['prefix' => 'admin','namespace' => 'Admin'], function() use ($router)
{
    // 使用 "App\Http\Controllers\Admin" 命名空间...
    
    $router->get('user/index', 'UserController@index');
    $router->get('user/test', function($id){return 111;});
});