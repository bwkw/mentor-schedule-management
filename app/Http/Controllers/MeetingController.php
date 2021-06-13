<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    //ログイン認証
    public function __construct()
    {
        $this->middleware('auth');
    }

    //meetingsテーブルに予定を格納
    public function store(Meeting $meeting, Request $request)
    {
        $input_meeting = $request['meeting'];
        $meeting->fill($input_meeting)->save();
        return redirect('/');
    }
}
