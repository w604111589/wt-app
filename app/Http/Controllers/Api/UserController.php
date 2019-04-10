<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Res;
use App\Http\Models\Api\User;

class UserController extends Controller{

    /**
     * @path（‘user/index’）
     * @return array()
     */
    public function index(){

        $res = User::selectAll('SELECT * FROM wt_user');
        return Res::success($res);
    }

    public function test(){

        $res =  Res::success(["name"=>"wangtao"]);

        return $res;
        
    }

    /**
     * User login
     * @path('user/login')
     * @return array()
     */
    public function login(){
        if ($request->has('login_name') && $request->has('password')) {
            $user = User:: where("login_name", "=", $request->input('login_name'))
                ->where("password", "=", $this->salt.$request->input('password'))
                ->first();
     
            if ($user) {
                $token=str_random(60);
                $user->api_token=$token;
                $user->save();
                return $user->api_token;
            } else {
            return "用户名或密码不正确，登录失败！";
          }
        } else {
          return "登录信息不完整，请输入用户名和密码登录！";
        }

        // $res = User::selectAll('SELECT * FROM wt_user');
        // return Res::success($res);
    }

    public function loginout(){
        
    }
}