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

		$labels = static::getLabelByIds([$res->id]);
		$label_infos = [];
		foreach($labels as $label){				
			if($res->id == $label->article_id){
				array_push($label_infos,$label->label_id);
			}	
		}
		$res->labels = $label_infos;
		return $res;
	}

	public static function selectData($page=1,$limit=20,$search){
		$query = DB::table('wt_article');
		if( isset($GLOBALS['userid']) && !in_array($GLOBALS['userid'] ,[10000,10001])){
			$query->where('creater_id',$GLOBALS['userid']);
		}else{
			$query->where('status',1);
		}
		if($search) $query->where('abstract','like',"%$search%");
		$res['total'] = $query->count();
		$res['items'] = $query->skip(($page-1)*$limit)->take($limit)->get()->toArray();

		$ids = [];
		foreach($res['items'] as $value){
			array_push($ids,$value->id);
		}

		if(!$ids) return $res;

		$labels = static::getLabelByIds($ids);

		foreach($res['items'] as $key=> $value){
			$label_infos = [];
			foreach($labels as $label){				
				if($value->id == $label->article_id){
					array_push($label_infos,$label->label_id);
				}	
			}
			$res['items'][$key]->labels = $label_infos;
		}

		return $res;
	}

	public static function getLabelByIds($ids=[]){
		if(!$ids) return [];
		$res = DB::table('wt_art_label')->whereIn('article_id',$ids)->select('article_id','label_id')->get();
		// print_r($res);die;
		return $res;

	}

	public static function insertData($input,$labels){


		$input['create_time'] = $input['update_time'] = date('Y-m-d h:i:s');
		$input['creater_id'] = $GLOBALS['userid'];
		// $res = DB::table('wt_article')->insert($input);
		$res = DB::table('wt_article')->insertGetId($input);
		if($labels){
			self::saveLabels($labels,$res);
		}
		return $res;

	}

	public static function updateData($input,$labels){

		if($labels){
			self::saveLabels($labels,$input['id']);
		}
		$input['update_time'] = date('Y-m-d h:i:s');
		$res = DB::table('wt_article')->where('id',$input['id'])->update($input);
		return $res;

	}

	//存储标签
	public static function saveLabels($labels,$id=0){
		$create_time = date('Y-m-d h:i:s');
		//获取列pluck
		// DB::table('wt_art_label')->where(['article_id' ,'=' ,$id] )->pluck('lable_id');
		if($id){
			DB::table('wt_art_label')->where('article_id' ,$id)->delete();
		}

		foreach($labels as $value){		
			$res = DB::table('wt_art_label')->insert(['label_id'=>$value,'article_id'=>$id,'create_time'=>$create_time]);	
		}

	}


}