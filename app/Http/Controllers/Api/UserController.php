<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller{

    /**
     * @path（‘user/index’）
     * @return array()
     */
    public function index(){
        $results = DB::select('SELECT * FROM wt_user');
        return $results['11'];
    }

    public function test(){
        
        return "wo shi yi ge zhongguoren";
    }
}