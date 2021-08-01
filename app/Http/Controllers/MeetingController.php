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
        $your_meetings = User::find(Auth::user()->id)->meetings;
        return $your_meetings;
    }
    
    /**
     * 面談日時を保存
     */
    public function store(Meeting $meeting, MeetingRegisterRequest $request)
    {
        $input_meeting = $request['meeting'];
        $meeting->fill($input_meeting)->save();
        return redirect('/');
    }
    
    /**
     * 面談日時登録ページへの遷移
     */
    public function register()
    {
        $your_name = Auth::user()->name;
        $students = \DB::table('students')->get();
        return view('Meeting.register') -> with(
            [
                'your_name' => $your_name,
                'students' => $students,
            ]
        );
    }
    
    /**
     * 面談日時の削除
     */
    public function delete(Meeting $meeting)
    {
        $meeting -> delete();
        return redirect('/');
    }
    
    /**
     * 面談日時編集ページへの遷移
     */
    public function edit(Meeting $meeting)
    {
        return view('Meeting.edit') -> with( ['meeting' => $meeting] );
    }
    
    /**
     * 面談日時の更新
     */
    public function update(Meeting $meeting, Request $request)
    {
        $input_meeting_editted = $request['meeting'];
        $meeting->fill($input_meeting_editted)->save();
        return redirect('/');
    }
}
