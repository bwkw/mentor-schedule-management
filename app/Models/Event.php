<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * イベント予定用モデルクラス
 */
class Event extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
}
