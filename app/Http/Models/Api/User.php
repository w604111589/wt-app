<?php

namespace App\Http\Models\Api;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
class User extends Model{

	protected $table ="wt_user";

	public static function selectAll(){

		$res = DB::select('SELECT * FROM wt_user');
		return $res;
	}

	public static function searchUser($author){

		$res = [];
		$res['items'] = DB::table('wt_user')->where('username','like',"{$author}%")->select('id','username')->get();
		return $res;
	}

	public static function updateavatar($avatar){
		
		$res = DB::table('wt_user')->where('username','=',$GLOBALS['username'])->update(['avatar' => $avatar ]);
		return $res;
	}

}