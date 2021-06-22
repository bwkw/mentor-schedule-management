<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    // ログイン認証
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ユーザー情報に紐づいてmeetingsテーブルのデータを表示する
    public function index()
    {
        $your_meetings = User::find(Auth::user()->id)->meetings;
        return $your_meetings;
    }
    
    // meetingsテーブルに予定を格納
    public function store(Meeting $meeting, Request $request)
    {
        $input_meeting = $request['meeting'];
        $meeting->fill($input_meeting)->save();
        return redirect('/');
    }
    
    // 面談日時登録ページへの遷移
    public function register()
    {
        // メンターと生徒の名前をそれぞれのテーブルから取得
        $mentors = \DB::table('mentors')->get();
        $students = \DB::table('students')->get();
        return view('Meeting.register') -> with(
            [
                'mentors' => $mentors,
                'students' => $students,
            ]
        );
    }
    
    // 面談日時を削除
    public function delete(Meeting $meeting)
    {
        $meeting -> delete();
        return redirect('/');
    }
}