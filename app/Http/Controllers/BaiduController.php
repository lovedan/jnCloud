<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;

class BaiduController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            // 授权通过
            if(isset($_GET['code']) && !empty($_GET['code'])) 
            {
                
            	$result = $this->get_by_curl('https://www.syncy.cn/oauth','method=get_access_token&sign=wp2pcs-sy&code='.$_GET['code']);

            	$result_array = json_decode($result,true);

            	if(!isset($result_array['access_token']) || !$result_array['refresh_token']){
            	    echo "授权失败";
            		exit;
            	}else{
//                    session(["access_token" => $result_array['access_token']]);
//                    session(["refresh_token" => $result_array['refresh_token']]);
                    $access_token = Cookie::forever('access_token', $result_array['access_token']);
                    $refresh_token = Cookie::forever('refresh_token', $result_array['refresh_token']);
                    Cookie::queue($access_token);
                    Cookie::queue($refresh_token);
            	    return redirect('/home');
            	}
            }
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function get_by_curl($url,$post = false){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	if($post){
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	}
	//下面7个curl_setopt由wishinlife添加
	if(strtolower(substr($url,0,5)) == 'https')
	{
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// 对认证证书来源的检查
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);// 从证书中检查SSL加密算法是否存在
	}
	curl_setopt($ch, CURLOPT_FRESH_CONNECT, false);  
	curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
	curl_setopt($ch, CURLOPT_TIMEOUT, 60); // 设置超时限制防止死循环
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);

	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}   
}
