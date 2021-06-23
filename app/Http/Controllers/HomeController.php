<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Event;
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
        // 現在の日時を取得
        $now_date = date('Y-m-d');
        $now_time = date('H:i:s');
        
        // 「現在の日付より前」かつ、「現在の時刻より終了時間が前」の情報をテーブルから削除
        Meeting::where('date', '<=', $now_date) -> where('ending_time', '<=', $now_time) -> delete();
        Event::where('date', '<=', $now_date) -> where('ending_time', '<=', $now_time) -> delete();

        $meetings = Meeting::get();
        $events = Event::get();
        // 二つのオブジェクトを結合する
        $meetings_events = (object)array_merge_recursive((array) $meetings, (array) $events);
        
        // オブジェクトを配列に
        $meetings_events_array = "";
        foreach($meetings_events as $meeting_event)
        {
            $meetings_events_array = $meeting_event;
        }
        
        // 配列からdate(日付)、starting_time（開始時間)、ending_time(終了時間)を取得する
        $dates = array_column($meetings_events_array, 'date');
        $beginning_times = array_column($meetings_events_array, 'beginning_time');
        $ending_times = array_column($meetings_events_array, 'ending_time');
        
        // 取得したdate(日付)、starting_time（開始時間)、ending_time(終了時間)を基に、配列を並び替える
        array_multisort(array_map("strtotime", $dates), SORT_ASC,
                        array_map("strtotime", $beginning_times), SORT_ASC,
                        array_map("strtotime", $ending_times), SORT_ASC, $meetings_events_array);

        return view('Home.home') -> with(['meetings_events_array' => $meetings_events_array]);
    }
}
