<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Res;
use App\Http\Models\Api\User;
use App\Models\Jwt;
use Illuminate\Http\Request;

class LoginController extends Controller{

    // protected $jwt;

    // public function __construct(JWTAuth $jwt)
    // {
    //     $this->jwt = $jwt;
    // }

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
                    'sub'=>$user['id'].'/'.$user['username'],
                    'jti'=>md5(uniqid('JWT').time())
                ];

                $jwt=new Jwt;
                $token=$jwt -> getToken($payload);
                $this->getLoginInfo($user['username']);
                return Res::success(['token'=>$token]);
            }else{
                $reason = "用户名或密码不正确,登录失败";
                $this->getLoginInfo($request->input('username'),0,$reason);
                return Res::fail($reason);
            }
        }else{
            $reason = "登录信息不完整,请输入用户名和密码";
            $this->getLoginInfo($request->input('username'),0,$reason);
            return Res::fail($reason);
        }
        // return response()->json(compact('token'));

    }

    /**
     * @author(wt)
     * 返回登陆的数据
     */
    private function getLoginInfo($username,$status=1,$reason="登陆成功"){
        $res=[];
        // print_r($_SERVER);die;
        $res['login_address'] = $_SERVER['HTTP_USER_AGENT'];
        $res['login_ip'] = $_SERVER['REMOTE_ADDR'];
        $res['username'] = $username;
        $res['create_time'] = date('Y-m-d');
        $res['login_reason'] = $reason;
        $res['login_status'] = $status;

        User::createLogin($res);
        
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