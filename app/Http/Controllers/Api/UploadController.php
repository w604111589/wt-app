<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Res;

class UploadController extends Controller{

	public $rootPath = "uploads/";

	public $extension = ['jpeg','gif','png','jpg'];

	public $maxPicMount = 4;

	public $maxSize = 1024*1024*5;

	public $maxSizeM = '5M';

    /**
     * @author w604111589
     * @path('upload') 文章列表
     * @param Resquest $request
     * @return array()
     */
    public function index(Request $request){

        $file=$request->file('file');
        // print_r(base_path());die;
        if(!$file->isValid()){
           return  Res::fail('文件不合法');
        }
        $fileextension=$file->getClientOriginalExtension();

        if(!in_array($fileextension,$this->extension )){
            return  Res::fail('只支持jpeg、gig、png、jpg文件格式上传'); 
        }
        
        $path = $this->createDirAndUpload($file);
		if($path){ 
			return Res::success(["pathurl"=>$path],'文件上传成功');
		}

        return  Res::fail('文件上传失败');
    }
    
    //创建目录并保存文件
    public function createDirAndUpload($file){
        $dataDir = $this->rootPath.date('Y-m-d').'/';
        // // print_r($dataDir);die;
        // print_r(base_path().'/'.$dataDir);die;
        $fullPathdir = base_path().'/public/'.$dataDir;
		if(!is_dir($fullPathdir)){
			mkdir($fullPathdir);
		}
        $domain = $_SERVER['HTTP_HOST'];
        $name = time().rand(0,999).'_'.$file->getClientOriginalName();
        $relativePath = $dataDir.$name;
        $fullPath = base_path().'/public/'.$relativePath;

		if (!file_exists($fullPath)){
            $path = 'http://'.$domain.'/'.$relativePath;
            // move_uploaded_file($_FILES["imageFile"]["tmp_name"],$fullPath);
            $file->move($fullPathdir,$name);
			return $path;
		}
		return '';
    }



}