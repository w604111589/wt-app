<?php

namespace App\Http\Models\Api;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
class Message extends Model{

	protected $table ="wt_user";

	public static function selectData($page,$limit){
		$query = DB::table('wt_message')->where("userid",'=',$GLOBALS['userid']);
		$res['total'] = $query->count();
		$res['items'] = $query->skip(($page-1)*$limit)->take($limit)->get();
		return $res;
	}

	

}