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
    $access_token = Cookie::get('access_token');
    $refresh_token = Cookie::get('refresh_token');
    $ty_access_token = Cookie::get('ty_access_token');
    $ty_refresh_token = Cookie::get('ty_refresh_token');
    if((empty($access_token) || empty($refresh_token)) && (empty($ty_access_token) || empty($ty_refresh_token))){
        return view('welcome');
    }
    if(!empty($access_token) && !empty($refresh_token)){
        return redirect('/home');
    }
    if(!empty($ty_access_token) && !empty($ty_refresh_token)){
        return redirect('/tyhome');
    }
});

Route::get('/baidu', function () {
    return redirect('https://openapi.baidu.com/oauth/2.0/authorize?response_type=code&client_id=uFBSHEwWE6DD94SQx9z77vgG&redirect_uri=oob&scope=basic%20netdisk');
});
//Route::get('/baidu', function() {
//    $backuri = config('app.url')."/auth?";
//    return redirect('http://openapi.baidu.com/oauth/2.0/authorize?client_id=dqSQouI90u33xGGUZzMWASZY&response_type=code&redirect_uri=http%3A%2F%2Fwww.syncy.cn%2Foauth%3Fmethod%3Dgranted&scope=basic%20netdisk&confirm_login=1&state=auth_code%23'.urlencode($backuri));
//});

Route::get('/tianyi', function () {
//    $backuri = config('app.url')."/tyauth?";
    return redirect('https://oauth.api.189.cn/emp/oauth2/v3/authorize?app_id=972441510000259880&response_type=code&redirect_uri=' .
        urlencode(config('app.tyredirect_uri')));
});

Route::get('/bdauth', 'BaiduController@bdAuth');
Route::get('/tyauth', 'BaiduController@tyAuth');

//Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/tyhome', 'HomeController@tyindex');

Route::pattern('path', '[\s\S]*');

Route::get('/images/{path}', 'ImagesController@index');

Route::get('/register', 'RegController@index');

Route::post('/logout', 'RegController@logout');

Route::post('/getmsg', 'AjaxController@index');

Route::post('/upload', 'AjaxController@upload');

Route::post('/checkdel', 'AjaxController@checkdel');

Route::post('/newfolder', 'AjaxController@newfolder');
