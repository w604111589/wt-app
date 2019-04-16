<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Api\Article;
use Illuminate\Http\Request;
use App\Http\Models\Res;
use App\Models\User;

class MarkdownController extends Controller{


    /**
     * @author w604111589
     * @path('markdown/list') 文章列表
     * @param Resquest $request
     * @return array()
     */
    public function list(Request $request)
    {   
        $res = Article::selectAll();
        return Res::success($res);
    }

     /**
     * @author w604111589
     * @path('markdown/detail') 
     * @param Resquest $request
     * @return array()
     */
    public function detail(Request $request)
    {   
        if(!$request->filled('id')){
            return Res::fail("请求ID为必传参数，且不能为空");
        }
        $arr = $request->only('id');
        $res = Article::selectOneById($arr);
        return Res::success($res);
    }





}