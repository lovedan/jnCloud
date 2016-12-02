<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BaiduPCS;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $access_token = "21.8b49c1e977dc65d3dc51d1c7f0f7a0e2.2592000.1482660042.1158157186-2293434";
        $refresh_token = "22.f4e84fbd889e17bae881029480f20de4.315360000.1795428042.1158157186-2293434";

        $baidupcs = new BaiduPCS($access_token);

        // 当前路径相关信息
        $remote_dir = "/apps/SyncY";
        if(isset($_GET['dir']) && !empty($_GET['dir'])){
            $dir_pcs_path = str_replace('\\','',$_GET['dir']);
        }else{
            $dir_pcs_path = "/apps/SyncY";
        }

        $limit = "0-0";
        if(isset($_GET['orderby']) && !empty($_GET['orderby'])){
            $orderby = $_GET['orderby'];
        }
         else{
            $orderby = 'time-desc';
        }

        $orderby = explode('-', $orderby);
        $results = $baidupcs->listFiles($dir_pcs_path,$orderby[0],$orderby[1],$limit);
        $results = json_decode($results);
        $files_on_pcs = $results->list;

        var_dump($files_on_pcs);
        return view('home')->with("files_on_pcs",$files_on_pcs);
    }
}
