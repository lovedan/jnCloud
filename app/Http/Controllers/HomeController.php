<?php

namespace App\Http\Controllers;

use BaiduPCS;
use Cookie;
use TianyiPCS;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // 直接初始化全局变量
        global $baidupcs;
        global $access_token;
        global $refresh_token;

        //设置项目
        define('FILES_DIR', dirname(dirname(dirname(dirname(__FILE__)))) . '/public/users');    //设置目录，尾部不需要/
//        define('CONFIG_DIR',FILES_DIR.'/config');	//配置目录

        $access_token = Cookie::get('access_token');
        $refresh_token = Cookie::get('refresh_token');

        if (empty($access_token) || empty($refresh_token)) {
            return redirect('/');
        }

        $htaccess = json_decode(get_by_curl('https://d.pcs.baidu.com/rest/2.0/pcs/file?method=download&access_token=' . $access_token . '&path=' . config('app.bapppath') . '/'));

        $baidupcs = new BaiduPCS($access_token);
        session(["baidupcs" => $baidupcs]);
        // 当前路径相关信息
        $remote_dir = config('app.bapppath');

        if (isset($_GET['dir']) && !empty($_GET['dir'])) {
            $dir_pcs_path = str_replace('\\', '', $_GET['dir']);
        } else {
            $dir_pcs_path = config('app.bapppath');
        }

        $limit = "0-0";
        if (isset($_GET['orderby']) && !empty($_GET['orderby'])) {
            $orderby = $_GET['orderby'];
        } else {
            $orderby = 'time-desc';
        }
        $files_on_pcs = $this->wp_storage_to_pcs_media_list_files($dir_pcs_path, $limit, $orderby);

        $capacity = json_decode($baidupcs->getQuota());
        $userinfos = json_decode($baidupcs->getLoggedInUserInfo());

        if (!empty($capacity->error_code) || !empty($userinfos->error_code)) {
            Cookie::queue(Cookie::forget('access_token'));
            Cookie::queue(Cookie::forget('refresh_token'));
            return redirect('/?messages=授权失败');
        }
        //生成用户目录百度用户ID
        $userNewId = $userinfos->userid;
        $userPcsUrl = FILES_DIR . '/' . $userNewId;

        if (!file_exists($userPcsUrl)) {
            mkdir($userPcsUrl);
        }

        if (!empty($htaccess->error_code)) {
            $pcsUrl = "Redirect permanent /$userNewId/ https://d.pcs.baidu.com/rest/2.0/pcs/file?method=download&access_token=" . $access_token . "&path=" . config('app.bapppath') . "/";
            file_put_contents($userPcsUrl . '/' . '.htaccess', $pcsUrl);
        }

        return view('home')->with([
            "files_on_pcs" => $files_on_pcs,
            "access_token" => $access_token,
            "remote_dir" => $remote_dir,
            "dir_pcs_path" => $dir_pcs_path,
            "userNewId" => $userNewId,
            "capacity" => $capacity,
            "userinfos" => $userinfos,
            "created_at" => "created_at",
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tyindex()
    {
        // 直接初始化全局变量
        global $tianyipcs;
        global $ty_access_token;
        global $ty_refresh_token;

        $ty_access_token = Cookie::get('ty_access_token');
        $ty_refresh_token = Cookie::get('ty_refresh_token');

        if (empty($ty_access_token) || empty($ty_refresh_token)) {
            return redirect('/');
        }

        $tianyipcs = new TianyiPCS($ty_access_token,config("app.appid"));
        session(["tianyipcs" => $tianyipcs]);

        $currentFolderInfo = "";
        $folderInfo = array();
        if (isset($_GET['dirid']) && !empty($_GET['dirid'])) {
            $dirid = $_GET['dirid'];
            $currentFolderInfo = json_decode($tianyipcs->getFolderInfo($dirid,""));
        } else {
            $dirid = "";
        }

        if(!empty($currentFolderInfo->path)){
            $remote_dir = "/我的应用/天翼开放平台应用/jnClouds";
            $current_path = str_replace($remote_dir,'',$currentFolderInfo->path);
            $current_path_arr = array_filter(explode('/',$current_path));
            if(!empty($current_path_arr)){
                $i=0;
                $tempPath ="";
                foreach($current_path_arr as $key => $current_dir){
                    $tempFolderInfo = json_decode($tianyipcs->getFolderInfo("",$remote_dir."/".$tempPath));
                    $folderInfo[$i]["folderid"] = number_format($tempFolderInfo->id,0,"","");
                    $folderInfo[$i]["folderpath"] = $current_dir;
                    $i++;
                    $tempPath .=$current_dir."/";
                }
            }
        }

        $fileList=json_decode($tianyipcs->listFiles($dirid));

        if ($fileList->res_code != 0) {
            Cookie::queue(Cookie::forget('ty_access_token'));
            Cookie::queue(Cookie::forget('ty_refresh_token'));
            return redirect('/?messages=授权失败');
        }
        $userinfos = json_decode($tianyipcs->getLoggedInUserInfo());
        if (empty($userinfos->user_nickname)) $userinfos->user_nickname = "江南云用户";
        $capacity = json_decode($tianyipcs->getQuota());

        return view('tyhome')->with([
            "files_on_pcs" => $fileList->fileList,
            "access_token" => $ty_access_token,
            "userinfos" => $userinfos,
            "capacity" => $capacity,
            "folderInfo" => $folderInfo,
        ]);
    }
    // 用一个函数来列出PCS中某个目录下的所有文件（夹）
    public function wp_storage_to_pcs_media_list_files($dir_pcs_path, $limit, $orderby = 'time-desc')
    {
        global $baidupcs;
        $orderby = explode('-', $orderby);
        $results = $baidupcs->listFiles($dir_pcs_path, $orderby[0], $orderby[1], $limit);
        $results = json_decode($results);
        if (!empty($results->list)) {
            $results = $results->list;
            return $results;
        } else {
            return null;
        }
    }

    // 用一个函数来显示这些文件（或目录）
    public function wp_storage_to_pcs_media_thumbnail($file_pcs_path, $user_file_name, $width = 120, $height = 1600, $quality = 100)
    {
        // 使用直链，有利于快速显示图片
        $image_outlink_per = $user_file_name;
        $file_pcs_path = str_replace($this->trailing_slash_path(config('app.bapppath')), '', $file_pcs_path);
        $thumbnail = urldecode($image_outlink_per . $file_pcs_path);
        return $thumbnail;
    }

    // 解决路径最后的slah尾巴，如果没有则加上，而且根据不同的服务器，采用/或者\
    public function trailing_slash_path($path_string, $is_win = false)
    {
        $trail = substr($path_string, -1);
        if ($is_win) {
            if ($trail != '/' && $trail != '\\') {
                $path_string .= '\\';
            }
        } else {
            if ($trail != '/') {
                $path_string .= '/';
            }
        }
        return $path_string;
    }
}
