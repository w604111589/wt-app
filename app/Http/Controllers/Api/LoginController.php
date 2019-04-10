<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Res;
// use App\Http\Models\Api\User;
use App\User;

class LoginController extends Controller{

    private $salt;

    public function __construct()
    {
        $this->salt = "userloginregister";
    }
    //登录
    public function login(Request $request)
    {
        if($request->has('login_name') && $request->has('password')){
            $user = User::where('login_name', '=', $request->input('login_name'))->where('password', '=', $this->salt.$request->input('password'))->first();
            if($user){
                $token = str_random(60);
                $user->api_token = $token;
                $user->save();
                return $user->api_token;
            }else{
                return '用户名或密码不正确,登录失败';
            }
        }else{
            return '登录信息不完整,请输入用户名和密码';
        }
    }
    //注册
    public function register(Request $request)
    {
        if($request->has('login_name') && $request->has('password') && $request->has('email')){
            $user = new User;
            $user->username = $request->input('login_name');
            $user->password = $this->salt.$request->input('password');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->api_token = str_random(60);
            if($user->save()){
                return '用户注册成功!';
            }else{
                return '用户注册失败!';
            }
        }else{
            return '请输入完整用户信息!';
        }
    }
}