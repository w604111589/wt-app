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


$router->get('example/index', 'ExampleController@index');
$router->get('user/index', 'UserController@index');

$router->group(['prefix' => 'v1','namespace' => 'Api'], function() use ($router)
{
    // 使用 "App\Http\Controllers\Api" 命名空间...
    $router->get('login', 'loginController@login');
    $router->group(['middleware'=>'auth'],function() use ($router){
        $router->get('user/index', 'UserController@index');
        $router->get('user/test', 'UserController@test');
    });


});


$router->group(['prefix' => 'admin','namespace' => 'Admin'], function() use ($router)
{
    // 使用 "App\Http\Controllers\Admin" 命名空间...
    
    $router->get('user/index', 'UserController@index');
    $router->get('user/test', function($id){return 111;});
});