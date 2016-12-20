<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use BaiduPCS;
use Auth;

class ImagesController extends Controller
{
    public function index($path)
    {
        $thumbnail = session("baidupcs")->thumbnail($path, '50', '50');
        return $thumbnail;
    }
}
