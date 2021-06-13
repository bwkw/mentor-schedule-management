<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    //ログイン認証
    public function __construct()
    {
        $this->middleware('auth');
    }

    //スケジュール（ミーティング/イベント）登録ページ
    public function register()
    {
        return view('Schedule.register');
    }
}