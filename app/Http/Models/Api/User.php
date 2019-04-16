<?php

namespace App\Http\Models\Api;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
class User extends Model{

	public function selectOne(){

	}

	public static function selectAll(){

		$res = DB::select('SELECT * FROM wt_user');
		return $res;
	}

	public static function searchUser($author){
		// print_r($author);die;
		$res = [];
		$res['items'] = DB::table('wt_user')->where('username','like',"{$author}%")->select('id','username')->get();
		return $res;
	}

}