<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Res;
use App\Http\Models\Api\Label;
use Illuminate\Http\Request;


class LabelController extends Controller{

    public function index(Request $request){
        $page = $request->input('page',1);
        $limit = $request->input('limit',20);
        $res = Label::selectData($page,$limit);
        return Res::success($res);
    }

    public function create(Request $request){
        if(!$request->input('name')){return Res::fail("标签名不存在");}
        $input = $request->all();
        $res = Label::createData($input);
        return Res::success($res);
    }

    public function update(Request $request){
        if(!$request->input('name')){return Res::fail("标签名不存在"); }
        
        $input = $request->only('id','name','status');
        $res = Label::updateData($input);
        return Res::success($res);
    }
}