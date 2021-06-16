<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    // 指定したカラムに対してfillが出来るように$fillable定義
    protected $fillable = [
        'mentor_name',
        'student_name',
        'date',
        'starting_time',
        'ending_time',
        'user_id',
    ];
}
