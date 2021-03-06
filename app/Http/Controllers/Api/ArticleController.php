<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Api\Article;
use Illuminate\Http\Request;
use App\Http\Models\Res;
use App\Models\User;

class ArticleController extends Controller{


    /**
     * @author w604111589
     * @path('article/list') 11文章列表wt
     * @param Resquest $request
     * @return array()
     */
    public function list(Request $request)
    {   
        $page = $request->input('page',1);
        $limit = $request->input('limit',20);
        $search= $request->input('search');
        $res = Article::selectData($page,$limit,$search);
        return Res::success($res);
    }

     /**
     * @author w604111589
     * @path('article/detail') 
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


     /**
     * @author w604111589
     * @path('article/create') 
     * @param Resquest $request
     * @return array()
     */
    public function create(Request $request)
    {   
        $input = $request->except(['token','platforms','labels']);
        $labels = $request->input('labels',[]);
        $res = Article::insertData($input,$labels);
        return Res::success($res);
    }

     /**
     * @author w604111589
     * @path('article/update') 
     * @param Resquest $request
     * @return array()
     */

    public function update(Request $request)
    {   
        $input = $request->except(['token','labels','platforms',]);
        $labels = $request->input('labels');
        $res = Article::updateData($input,$labels);
        return Res::success($res);
    }



}