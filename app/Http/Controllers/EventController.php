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
    
    // イベント日時登録ページ
    public function register()
    {
        // ユーザー（メンター）と生徒の名前を取得
        $your_name = Auth::user()->name;
        $students = \DB::table('students')->get();
        return view('Event.register') -> with(
            [
                'your_name' => $your_name,
                'students' => $students,
            ]
        );
    }
    
    // イベント日時を削除
    public function delete(Event $event)
    {
        $event -> delete();
        return redirect('/');
    }
    
    // イベント日時編集ページへの遷移
    public function edit(Event $event)
    {
        return view('Event.edit') -> with( ['event' => $event] );
    }
    
    // 面談日時の更新
    public function update(Event $event, Request $request)
    {
        $input_event_editted = $request['event'];
        $event->fill($input_event_editted)->save();
        return redirect('/');
    }
}
