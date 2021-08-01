<?php

namespace App\Http\Controllers;

use App\Http\Requests\MeetingRegisterRequest;
use App\Models\Meeting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * 面談予定用コントローラークラス
 */
class MeetingController extends Controller
{
    /**
     * 面談日時を取得
     */
    public function index()
    {
        $yourMeetings = User::find(Auth::user()->id)->meetings;
        return $yourMeetings;
    }
    
    /**
     * 面談日時を保存
     */
    public function store(Meeting $meeting, MeetingRegisterRequest $request)
    {
        $inputMeeting = $request['meeting'];
        $meeting->fill($inputMeeting)->save();
        return redirect('/');
    }
    
    /**
     * 面談日時登録ページへの遷移
     */
    public function register()
    {
        $yourName = Auth::user()->name;
        $students = \DB::table('students')->get();
        return view('Meeting.register')->with(
            [
                'yourName' => $yourName,
                'students' => $students,
            ]
        );
    }
    
    /**
     * 面談日時の削除
     */
    public function delete(Meeting $meeting)
    {
        $meeting->delete();
        return redirect('/');
    }
    
    /**
     * 面談日時編集ページへの遷移
     */
    public function edit(Meeting $meeting)
    {
        return view('Meeting.edit')->with( ['meeting' => $meeting] );
    }
    
    /**
     * 面談日時の更新
     */
    public function update(Meeting $meeting, Request $request)
    {
        $inputMeetinEditted = $request['meeting'];
        $meeting->fill($inputMeetinEditted )->save();
        return redirect('/');
    }
}
