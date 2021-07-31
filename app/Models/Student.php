<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 生徒用モデルクラス
 */
class Student extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
    
    /**
     * 生徒情報を取得する
     * 
     * @param string 取得対象の生徒名
     */
    public function getStudentData($studentName)
    {
        $studentData = Student::where('slack_name', '=', $studentName)->first();
        return $studentData;
    }
}
