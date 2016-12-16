<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;
use View;
use Response;

class RegController extends Controller
{
    public function index(){

        $access_token = Cookie::get('access_token');
        $refresh_token = Cookie::get('refresh_token');

        if(empty($access_token) || empty($refresh_token)){
            return redirect('/baidu');
        }else{
            return redirect('/home');
        }
    }

    public function logout(){

        Cookie::queue(Cookie::forget('access_token'));
        Cookie::queue(Cookie::forget('refresh_token'));

        return redirect('/');
    }
}
