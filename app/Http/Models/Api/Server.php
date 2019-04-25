<?php

namespace App\Http\Models\Api;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
class Server extends Model{

	protected $table = "wt_server";

	public static function getCpuInfo($arr=[],$limit=300){
		$query = DB::table('wt_server');

		foreach($arr as $key=>$value){
			if($value){
				$query->where($key,$value);
			}
		}
		// print_r($limit);die;
		// $res = $query->take($limit)->pluck('cpu_load','create_time');
		$res = $query->take($limit)->select('cpu_load','create_time')->get();
		return $res;
	}

	public static function getCpuInfoOne($arr=[]){
		$query = DB::table('wt_server');

		foreach($arr as $key=>$value){
			if($value){
				$query->where($key,$value);
			}
		}
		// print_r($limit);die;
		// $res = $query->take($limit)->pluck('cpu_load','create_time');
		$res = $query->select('cpu_load','create_time')->first();
		return $res;
	}


}