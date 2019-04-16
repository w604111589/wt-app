<?php

namespace App\Http\Models;


class Res{

	public static function success($data = [], $msg = "Request Success | 请求成功"){
		$arr = [];
		// $arr['code'] = 200;
		$arr['status'] = 200;
		$arr['data'] = $data;
		$arr['msg'] = $msg;
		$arr['time'] = \date('Y-m-d h:i:s');
		return $arr;

	}

	public static function fail($msg="Request Fail",$code=300,$data=[]){

		$arr = [];
		// $arr['code'] = $code;
		$arr['status'] = 200;
		$arr['data'] = $data;
		$arr['msg'] = $msg;
		$arr['time'] = \date('Y-m-d h:i:s');
		return $arr;
	}
}
