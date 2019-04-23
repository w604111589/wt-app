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

	public static function selectUserByUsername($username){
		$res = DB::table('wt_user')->where('username',$username)->select('id','username')->first();
		return $res;
	}

	public static function createUser($input){
		$input['create_time'] = $input['update_time'] = date('Y-m-d h:i:s');
		$res = DB::table('wt_user')->insert($input);
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

	public static function createLogin($loginInfo){
		$res = DB::table('wt_loginlog')->insert($loginInfo);
		return $res;
	}

	public static function getLoginlog($page,$limit){
		$query = DB::table('wt_loginlog')->where("username",'=',$GLOBALS['username']);
		$res['total'] = $query->count();
		$res['items'] = $query->skip(($page-1)*$limit)->take($limit)->get();
		return $res;
	}

}