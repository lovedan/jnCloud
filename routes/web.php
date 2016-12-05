<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/baidu', function() {

    $backuri = "http://www.jiangnan.pw/auth?";
    return redirect('http://openapi.baidu.com/oauth/2.0/authorize?client_id=dqSQouI90u33xGGUZzMWASZY&response_type=code&redirect_uri=http%3A%2F%2Fwww.syncy.cn%2Foauth%3Fmethod%3Dgranted&scope=basic,netdisk&confirm_login=1&state=auth_code%23'.urlencode($backuri));
});

Route::get('/auth', 'BaiduController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');
