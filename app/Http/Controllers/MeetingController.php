<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    //ログイン認証
    public function __construct()
    {
        $this->middleware('auth');
    }

    //ユーザー情報に紐づいてmeetingsテーブルのデータを表示する
    public function index()
    {
        $your_meetings = User::find(Auth::user()->id)->meetings;
        return $your_meetings;
    }
    
    //meetingsテーブルに予定を格納
    public function store(Meeting $meeting, Request $request)
    {
        $input_meeting = $request['meeting'];
        $meeting->fill($input_meeting)->save();
        return redirect('/');
    }
}
