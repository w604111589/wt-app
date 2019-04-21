<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Res;
use App\Http\Models\Api\User;
use Illuminate\Http\Request;

class UserController extends Controller{

    /**
     * @path（‘user/index’）
     * @return array()
     */
    public function index(Request $request){
        $user = User::where('username', '=', $GLOBALS['username'])->first();
        // $res = User::selectAll('SELECT * FROM wt_user');
        return Res::success($user);
    }

    /**
     * @path（‘user/index’） //根据用户名搜索用户
     * @return array()
     */
    public function saveavatar(Request $request){
        
        

        $avatar = $request->input('avatarUrl');
        // print_r($arr);die;
        $res = User::updateavatar($avatar);
        return Res::success($res);
    }

    /**
     * @path（‘user/index’） //根据用户名搜索用户
     * @return array()
     */
    public function search(Request $request){

        $arr = $request->only('author');
        
        $res = User::searchUser($arr['author']);
        return Res::success($res);
    }

        /**
     * @path（‘user/loginlog’） //根据用户名搜索用户
     * @return array()
     */
    public function loginlog(Request $request){
        $page = $request->input('page',1);
        $limit = $request->input('limit',20);
        $res = User::getLoginlog($page,$limit);
        return Res::success($res);
    }

}