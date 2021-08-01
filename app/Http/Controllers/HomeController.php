<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Meeting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * ホーム用コントローラークラス
 */
class HomeController extends Controller
{
    /**
     * meetingsテーブルとeventsテーブルから今後の予定を取得し、時系列で並び替える
     */
    public function index(Meeting $meeting, Event $event)
    {
        // 現在の日時を取得
        $nowDate = date('Y-m-d');
        $nowTime = date('H:i:s');
        
        // 「現在の日付より前」かつ、「現在の時刻より終了時間が前」の情報をmeetings,eventsテーブルから削除
        $meeting->formerMeetingsDelete($nowDate, $nowTime);
        $event->formerEventsDelete($nowDate, $nowTime);

        // ユーザー情報に基づいて、meetingsテーブルとeventsテーブルから情報を取得
        $meetings = User::find(Auth::user()->id)->meetings;
        $events = User::find(Auth::user()->id)->events;
        
        // それぞれのオブジェクトを連想配列にし、結合する
        $meetings = json_decode($meetings, true);
        $events = json_decode($events, true);
        $meetingsEvents = array_merge($meetings, $events);
        
        // 連想配列からdate(日付)、starting_time（開始時間)、ending_time(終了時間)を取得する
        $dates = array_column($meetingsEvents, 'date');
        $beginningTimes = array_column($meetingsEvents, 'beginning_time');
        $endingTimes = array_column($meetingsEvents, 'ending_time');
        
        // 取得したdate(日付)、starting_time（開始時間)、ending_time(終了時間)を基に、連想配列を並び替える
        array_multisort(array_map("strtotime", $dates), SORT_ASC,
                        array_map("strtotime", $beginningTimes), SORT_ASC,
                        array_map("strtotime", $endingTimes), SORT_ASC, $meetingsEvents);
        
        return view('Home.home')->with(['meetingsEvents' => $meetingsEvents]);
    }
}
