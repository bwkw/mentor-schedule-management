<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MeetingRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'meeting.student_name' => 'required',
            'meeting.how_to' => 'required',
    	    'meeting.date' => 'required',
    	    'meeting.beginning_time' => 'required',
    	    'meeting.ending_time' => 'required',
        ];
    }
    
    public function messages(){
        return [
            'meeting.student_name.required'  => '生徒氏名を入力してください。',
            'meeting.how_to.required'  => '面談形式を入力してください',
            'meeting.date.required' => '日付を入力してください。',
    	    'meeting.beginning_time.required' => '開始時間を入力してください。',
    	    'meeting.ending_time.required' => '終了時間を入力してください。',
        ];
    }
}
