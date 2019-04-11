<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Res;
use App\Models\User;
use App\Models\Jwt;

class LoginController extends Controller{

    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * 登录
     *
     * @author AdamTyn
     *
     * @param \Illuminate\Http\Request;
     * @return \Illuminate\Http\Response;
     */
    public function login(Request $request)
    {
        if($request->has('username') && $request->has('password')){
            $user = User::where('username', '=', $request->input('username'))->where('password', '=', $request->input('password'))->first();
            if($user){
                $payload = [
                    'iss'=>'w604111589',
                    'iat'=>time(),
                    'exp'=>time()+7200,
                    'nbf'=>time(),
                    'sub'=>$user['username'],
                    'jti'=>md5(uniqid('JWT').time())
                ];

                $jwt=new Jwt;
                $token=$jwt -> getToken($payload);
                return Res::success(['token'=>$token]);
            }else{
                return '用户名或密码不正确,登录失败';
            }
        }else{
            return '登录信息不完整,请输入用户名和密码';
        }

        return response()->json(compact('token'));

    }
    
    /**
     * @author w604111589
     * @path('register') 注册
     * @param Resquest $request
     * @return array()
     */
    public function register(Request $request)
    {
        // return Auth::guard();
    }

    /**
     * @author w604111589
     * @path('logout') 登出
     * @param Resquest $request
     * @return array()
     */
    public function logout(Request $request){

    }
}