<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * メンター用モデルクラス
 */
class Mentor extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
}
