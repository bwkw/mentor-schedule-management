<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRegisterRequest;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * イベント予定用コントローラークラス
 */
class EventController extends Controller
{
    /**
     * イベント日時を取得
     */
    public function index()
    {
        $your_events = User::find(Auth::user()->id)->events;
        return $your_events;
    }
    
    /**
     * イベント日時を保存
     */
    public function store(Event $event, EventRegisterRequest $request)
    {
        $input_event = $request['event'];
        $event->fill($input_event)->save();
        return redirect('/');
    }
    
    /**
     * イベント日時登録ページへの遷移
     */
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
    
    /**
     * イベント日時を削除
     */
    public function delete(Event $event)
    {
        $event -> delete();
        return redirect('/');
    }
    
    /**
     * イベント日時編集ページへの遷移
     */
    public function edit(Event $event)
    {
        return view('Event.edit') -> with( ['event' => $event] );
    }
    
    /**
     * イベント日時の更新
     */
    public function update(Event $event, Request $request)
    {
        $input_event_editted = $request['event'];
        $event->fill($input_event_editted)->save();
        return redirect('/');
    }
}
