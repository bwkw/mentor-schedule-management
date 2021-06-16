<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // ログイン認証
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ユーザー情報に紐づいてeventsテーブルのデータを表示する
    public function index()
    {
        $your_events = User::find(Auth::user()->id)->events;
        return $your_events;
    }
    
    // eventsテーブルに予定を格納
    public function store(Event $event, Request $request)
    {
        $input_event = $request['event'];
        $event->fill($input_event)->save();
        return redirect('/');
    }
    
    // ミーティング登録ページ
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
}
