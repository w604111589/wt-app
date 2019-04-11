<?php

namespace App\Http\Models\Api;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
class Type extends Model{

	static $table;

	public function selectOne(){

	}

	public static function selectAll(){

		$res = DB::table('wt_type')->get();
		return $res;
	}

}