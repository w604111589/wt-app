<?php

namespace App\Http\Models\Api;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
class Label extends Model{

	protected $table ="wt_label";

	public static function selectData($page,$limit){
		$query = DB::table('wt_label');
		$res['total'] = $query->count();
		$res['items'] = $query->skip(($page-1)*$limit)->take($limit)->get();
		return $res;
	}
	
	public static function createData($input){
		$input['create_time'] = $input['update_time'] = date('Y-m-d h:i:s');
		$res = DB::table('wt_label')->insert($input);
		return $res;
	}

	public static function updateData($input){
		$input['update_time'] = date('Y-m-d h:i:s');
		$res = DB::table('wt_label')->where('id',$input['id'])->update($input);
		return $res;
	}

	

}