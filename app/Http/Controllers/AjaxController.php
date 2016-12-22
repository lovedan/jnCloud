<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use Cookie;
use Illuminate\Support\Facades\Input;
use BaiduPCS;

class AjaxController extends Controller
{
    public function index(){
        $msg = "This is a simple message.";
        return response()->json(array('msg'=> $msg), 200);
    }
    public function upload(Request $request){
        $baidupcs = new BaiduPCS(Cookie::get('access_token'));
        if($_POST["dir"] == 'null'){
            $remote_dir = config('app.bapppath');
        }else{
            $remote_dir = urldecode($_POST["dir"]);
        }
        $local_path = $_FILES['file']['tmp_name'];
        $file_name = $_FILES['file']['name'];
        $file_size = filesize($local_path);
        $handle = @fopen($local_path,'r');
        $file_content = fread($handle,$file_size);
        $result = $baidupcs->upload($file_content,$remote_dir.'/',$file_name);
        fclose($handle);
        return response()->json(array('msg'=> $result), 200);
    }
    public function checkdel(Request $request)
    {
        $baidupcs = new BaiduPCS(Cookie::get('access_token'));
        if(!empty($_POST['del'])){
            $delFiles= explode(',',$_POST['del']);
            $result = $baidupcs->deleteBatch($delFiles);
        }else{
            $result="";
        }
        $html = "";

        return response()->json(array('msg'=> $result,'html'=>$html), 200);
    }
    public function newfolder(Request $request){

        $baidupcs = new BaiduPCS(Cookie::get('access_token'));
        $folderName = $_POST["name"];
        if($_POST["dir"] == 'null' || empty($_POST["dir"])){
            $remote_dir = config('app.bapppath');
        }else{
            $remote_dir = urldecode($_POST["dir"]);
        }

        if($folderName == 'null' || empty($folderName)){
            $result = "请填写文件夹名";
        }else{
            $result = $baidupcs->makeDirectory($remote_dir.'/'.$folderName);
        }

        return response()->json(array('msg'=> $result), 200);
    }

}
