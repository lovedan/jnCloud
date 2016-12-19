<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
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
        $remote_dir = config('app.bapppath');
        if(is_array($_FILES['file']['tmp_name'])){
            var_dump($_FILES['file']['tmp_name']);
            exit;
            foreach ($_FILES['file']['tmp_name'] as $file){
                var_dump($file);
            }
        }
        exit;
        $local_path="C:\Users\FKJW068\Documents\ipmsg_img\ipmsgclip_r_1481690537_0.png";
        $file_name = basename($local_path);
        $file_size = filesize($local_path);
        $handle = @fopen($local_path,'r');
        $file_content = fread($handle,$file_size);
        $result = $baidupcs->upload($file_content,$remote_dir.'/',$file_name);
        fclose($handle);
        return response()->json(array('msg'=> $result), 200);
    }
}
