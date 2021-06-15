<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\Student;

use Illuminate\Http\Request;


class ScheduleController extends Controller
{
    // ログイン認証
    public function __construct()
    {
        $this->middleware('auth');
    }

    // スケジュール（ミーティング/イベント）登録ページ
    public function register()
    {
        // メンターと生徒の名前をそれぞれのテーブルから取得
        $mentors = \DB::table('mentors')->get();
        $students = \DB::table('students')->get();
        return view('Schedule.register') -> with(
            [
                'mentors' => $mentors,
                'students' => $students
            ]
            );
    }
}