<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Res;
use App\Http\Models\Api\Message;
use Illuminate\Http\Request;


class MessageController extends Controller{

    public function index(Request $request){
        $page = $request->input('page',1);
        $limit = $request->input('limit',20);
        $res = Message::selectData($page,$limit);
        return Res::success($res);
    }
}