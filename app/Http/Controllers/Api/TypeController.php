<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Res;
use App\Http\Models\Api\Type;

class TypeController extends Controller{

    /**
     * @author w604111589
     * @path('type/select') 获取类型
     * @param Resquest $request
     * @return array()
     */
    public function select(Request $request)
    {
        $res = Type::selectAll();
        return Res::success($res);
    }
    
    /**
     * @author w604111589
     * @path('register') 注册
     * @param Resquest $request
     * @return array()
     */
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

    /**
     * @author w604111589
     * @path('logout') 登出
     * @param Resquest $request
     * @return array()
     */
    public function logout(Request $request){

    }
}