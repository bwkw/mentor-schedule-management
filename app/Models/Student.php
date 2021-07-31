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
}
