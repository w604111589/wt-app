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

}