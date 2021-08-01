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
        $yourEvents = User::find(Auth::user()->id)->events;
        return $yourEvents;
    }
    
    /**
     * イベント日時を保存
     */
    public function store(Event $event, EventRegisterRequest $request)
    {
        $inputEvent = $request['event'];
        $event->fill($inputEvent)->save();
        return redirect('/');
    }
    
    /**
     * イベント日時登録ページへの遷移
     */
    public function register()
    {
        $yourName = Auth::user()->name;
        return view('Event.register')->with(
            [
                'yourName' => $yourName,
            ]
        );
    }
    
    /**
     * イベント日時を削除
     */
    public function delete(Event $event)
    {
        $event->delete();
        return redirect('/');
    }
    
    /**
     * イベント日時編集ページへの遷移
     */
    public function edit(Event $event)
    {
        return view('Event.edit')->with( ['event' => $event] );
    }
    
    /**
     * イベント日時の更新
     */
    public function update(Event $event, Request $request)
    {
        $inputEventEditted = $request['event'];
        $event->fill($inputEventEditted)->save();
        return redirect('/');
    }
}
