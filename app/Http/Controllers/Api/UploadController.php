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
        if(!$file) return  Res::fail('文件不存在');
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

    public function uploadbase64(Request $request){

        $file=$request->file('avatar');
        
        if(!$file) return  Res::fail('文件不存在');
        // $res = $this->base64EncodeImage($file);
        $res = $this->base64_image_content($file);
        if($res){
            return  Res::success(['pathurl'=> $res]);
        }
        return  Res::fail('文件上传失败');
    }

    //图片转base64编码
    public function base64EncodeImage ($image_file) {

        $base64_image = '';
        $image_info = getimagesize($image_file);
        $image_data = fread(fopen($image_file, 'r'), filesize($image_file));
        $base64_image = 'data:' . $image_info['mime'] . ';base64,' . chunk_split(base64_encode($image_data));
        return $base64_image;

    }

    //base64图片转换为图片并保存
    function base64_image_content($base64_image_content){
        //匹配出图片的格式
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
            $type = $result[2];
            print_r(11);die;
            $dataDir = $this->rootPath.date('Y-m-d').'/';
            $fullPathdir = base_path().'/public/'.$dataDir;
            if(!is_dir($fullPathdir)){
                mkdir($fullPathdir);
            }
            $domain = $_SERVER['HTTP_HOST'];
            $name = $new_file.time().".{$type}";
            $relativePath = $dataDir.$name;
            $fullPath = base_path().'/public/'.$relativePath;
            // $new_file = base_path().'/public/'.$dataDir;
            if (!file_exists($fullPath)){
                $path = 'http://'.$domain.'/'.$relativePath;
                if (file_put_contents($fullPath, base64_decode(str_replace($result[1], '', $base64_image_content)))){
                    return $path;
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
    }

}