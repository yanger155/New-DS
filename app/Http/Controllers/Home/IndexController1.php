<?php

namespace App\Http\Controllers\Home;

// 声明 Request 类
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('index.index');
    }
}
