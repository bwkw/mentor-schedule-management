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
        $meetings = \DB::table('meetings')->get();
        $events = \DB::table('events')->get();
        // 二つのオブジェクトを結合する
        $meetings_events = (object)array_merge_recursive((array) $meetings, (array) $events);
        
        // オブジェクトを配列に
        $meetings_events_array = "";
        foreach($meetings_events as $meeting_event)
        {
            $meetings_events_array=$meeting_event;
        }
        
        // 配列からdateとstarting_timeを取得し、日時で昇順に並び替える
        $dates = array_column($meetings_events_array, 'date');
        $starting_times = array_column($meetings_events_array, 'starting_time');
        array_multisort($dates, SORT_DESC, $meetings_events_array);
        array_multisort($starting_times, SORT_DESC, $meetings_events_array);
        //dd($meetings_events_array);
        return view('Home.home') -> with(['meetings_events_array' => $meetings_events_array]);
    }
}
