<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 面談予定用モデルクラス
 */
class Meeting extends Model
{
    // 指定したカラムに対してfillが出来るように$fillable定義
    protected $fillable = [
        'mentor_name',
        'student_name',
        'how_to',
        'date',
        'beginning_time',
        'ending_time',
        'user_id',
    ];
}
