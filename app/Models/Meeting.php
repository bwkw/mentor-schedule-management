<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 面談予定用モデルクラス
 */
class Meeting extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
}
