<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRegisterRequest extends FormRequest
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
            'event.event_name' => 'required',
    	    'event.date' => 'required',
    	    'event.beginning_time' => 'required',
    	    'event.ending_time' => 'required',
        ];
    }
    
    public function messages(){
        return [
            'event.event_name.required'  => 'イベント名を入力してください。',
            'event.date.required' => '日付を入力してください。',
    	    'event.beginning_time.required' => '開始時間を入力してください。',
    	    'event.ending_time.required' => '終了時間を入力してください。',
        ];
    }
}
