<?php

namespace App\Http\Models\Api;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
class Article extends Model{

	public static function selectOneById($arr){
		$query = DB::table('wt_article');
		foreach($arr as $key=>$value){
			if($value){
				$query->where($key,$value);
			}
		}
		$res = $query->first();
		return $res;
	}

	public static function selectAll(){
		$res = [];
		$res['items'] = DB::select('SELECT * FROM wt_article');
		$res['total'] = count($res['items']);

		return $res;
	}

	public static function insertData($input){
		$input['create_time'] = $input['update_time'] = date('Y-m-d h:i:s');
		$res = DB::table('wt_article')->insert($input);
		return $res;

	}

	public static function updateData($input){
		$input['update_time'] = date('Y-m-d h:i:s');
		$res = DB::table('wt_article')->where('id',$input['id'])->update($input);
		return $res;

	}


}