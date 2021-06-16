<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //ログイン認証
    public function __construct()
    {
        $this->middleware('auth');
    }

    //ホーム
    public function index()
    {
        
        return view('Home.home');
    }
}
