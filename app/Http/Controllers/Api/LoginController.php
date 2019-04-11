<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Res;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\SessionGuard;
// use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\JWTAuth;

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
        
        // print_r(111);die;
        // print_r($this->jwt);die;
        if (! $token = $this->jwt->attempt($request->only('username', 'password'))) {
            print_r(3123123);die;
            return response()->json(['user_not_found'], 404);
        }

        return response()->json(compact('token'));

    }

    public function guard()
    {
        // return Auth::guard();
    }

    // /**
    //  * 用户登出
    //  *
    //  * @author AdamTyn
    //  *
    //  * @return \Illuminate\Http\Response;
    //  */
    // public function logout()
    // {
    //     $response = array('code' => '0');

    //     Auth::invalidate(true);

    //     return response()->json($response);
    // }

    // /**
    //  * 更新用户Token
    //  *
    //  * @author AdamTyn
    //  *
    //  * @param \Illuminate\Http\Request;
    //  * @return \Illuminate\Http\Response;
    //  */
    // public function refreshToken()
    // {
    //     $response = array('code' => '0');

    //     if (!$token = Auth::refresh(true, true)) {
    //         $response['code']     = '5000';
    //         $response['errorMsg'] = '系统错误，无法生成令牌';
    //     } else {
    //         $response['data']['access_token'] = $token;
    //         $response['data']['expires_in']   = strval(time() + 86400);
    //     }

    //     return response()->json($response);
    // }
}