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

    if(empty($access_token) || empty($refresh_token)){
//        return redirect('/baidu');
        return view('welcome');
    }else{
        return redirect('/home');
    }

});

Route::get('/baidu', function() {
    return redirect('https://openapi.baidu.com/oauth/2.0/authorize?response_type=code&client_id=uFBSHEwWE6DD94SQx9z77vgG&redirect_uri=oob');
});
//Route::get('/baidu', function() {
//    $backuri = config('app.url')."/auth?";
//    return redirect('http://openapi.baidu.com/oauth/2.0/authorize?client_id=dqSQouI90u33xGGUZzMWASZY&response_type=code&redirect_uri=http%3A%2F%2Fwww.syncy.cn%2Foauth%3Fmethod%3Dgranted&scope=basic%20netdisk&confirm_login=1&state=auth_code%23'.urlencode($backuri));
//});

Route::get('/tianyi', function() {
    $backuri = config('app.url')."/auth?";
    return redirect('https://oauth.api.189.cn/emp/oauth2/v3/authorize?app_id=    &response_type=code&redirect_uri='.urlencode($backuri));
});

Route::get('/auth', 'BaiduController@index');

//Auth::routes();

Route::get('/home', 'HomeController@index');

Route::pattern('path', '[\s\S]*');

Route::get('/images/{path}', 'ImagesController@index');

Route::get('/register', 'RegController@index');

Route::post('/logout', 'RegController@logout');

Route::post('/getmsg','AjaxController@index');

Route::post('/upload','AjaxController@upload');

Route::post('/checkdel','AjaxController@checkdel');

Route::post('/newfolder','AjaxController@newfolder');
