<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BaiduPCS;
use Auth;
use Cookie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 直接初始化全局变量
        global $baidupcs;
        global $access_token;
        global $refresh_token;

        //设置项目
        define('FILES_DIR',dirname(dirname(dirname(dirname(__FILE__)))).'/public/users');	//设置目录，尾部不需要/
//        define('CONFIG_DIR',FILES_DIR.'/config');	//配置目录

        $access_token = Cookie::get('access_token');
        $refresh_token = Cookie::get('refresh_token');

        if(empty($access_token) || empty($refresh_token)){
            return redirect('/');
        }

        // $access_token = "21.8b49c1e977dc65d3dc51d1c7f0f7a0e2.2592000.1482660042.1158157186-2293434";
        // $refresh_token = "22.f4e84fbd889e17bae881029480f20de4.315360000.1795428042.1158157186-2293434";

        $baidupcs = new BaiduPCS($access_token);
        session(["baidupcs" => $baidupcs]);
        // 当前路径相关信息
        $remote_dir = config('app.bapppath');

        if(isset($_GET['dir']) && !empty($_GET['dir'])){
            $dir_pcs_path = str_replace('\\','',$_GET['dir']);
        }else{
        	$dir_pcs_path = config('app.bapppath');
        }

        $limit = "0-0";
        if(isset($_GET['orderby']) && !empty($_GET['orderby'])){
        	$orderby = $_GET['orderby'];}
        else{
        	$orderby = 'time-desc';
        }
        $files_on_pcs = $this->wp_storage_to_pcs_media_list_files($dir_pcs_path,$limit,$orderby);
        $capacity = json_decode($baidupcs->getQuota());
        $userinfos = json_decode($baidupcs->getLoggedInUserInfo());

        //生成用户目录百度用户ID
        $userNewId = $userinfos->userid;
        $userPcsUrl = FILES_DIR.'/'.$userNewId;

        if(!file_exists($userPcsUrl)){
            $pcsUrl = "Redirect permanent /$userNewId/ https://pcs.baidu.com/rest/2.0/pcs/file?method=download&access_token=".$access_token."&path=".config('app.bapppath')."/";
            mkdir($userPcsUrl);
            file_put_contents($userPcsUrl.'/'.'.htaccess',$pcsUrl);
        }

        return view('home')->with([
            "files_on_pcs"=>$files_on_pcs,
            "access_token"=>$access_token,
            "remote_dir"=>$remote_dir,
            "dir_pcs_path"=>$dir_pcs_path,
            "userNewId"=>$userNewId,
            "capacity"=>$capacity,
            "userinfos"=>$userinfos,
            "created_at"=>"created_at",
        ]);
    }

    // 用一个函数来列出PCS中某个目录下的所有文件（夹）
    public function wp_storage_to_pcs_media_list_files($dir_pcs_path,$limit,$orderby = 'time-desc'){
    	global $baidupcs;
    	$orderby = explode('-', $orderby);
    	$results = $baidupcs->listFiles($dir_pcs_path,$orderby[0],$orderby[1],$limit);
    	$results = json_decode($results);
        if(!empty($results->list)){
            $results = $results->list;
            return $results;
        }
        else{
            return null;
        }
    }
    // 用一个函数来显示这些文件（或目录）
    public function wp_storage_to_pcs_media_thumbnail($file_pcs_path,$user_file_name,$width = 120,$height = 1600,$quality = 100){
    	// 使用直链，有利于快速显示图片
    	$image_outlink_per = $user_file_name;
    	$file_pcs_path = str_replace($this->trailing_slash_path(config('app.bapppath')),'',$file_pcs_path);
    	$thumbnail = urldecode($image_outlink_per.$file_pcs_path);
    	return $thumbnail;
    }

    // 解决路径最后的slah尾巴，如果没有则加上，而且根据不同的服务器，采用/或者\
    public function trailing_slash_path($path_string,$is_win = false){
    	$trail = substr($path_string,-1);
    	if($is_win){
    		if($trail != '/' && $trail != '\\'){
    			$path_string .= '\\';
    		}
    	}else{
    		if($trail != '/'){
    			$path_string .= '/';
    		}
    	}
    	return $path_string;
    }
}
