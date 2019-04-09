<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(){
        // var_dump($request);die;
        $res = [
            'code'=>200,
            'data'=>[],
            'msg'=>"成功",
        ];
        return $res;
    }

    //
}
