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
    
    /**
     * 「現在の日付より前」かつ、「現在の時刻より終了時間が前」の情報を削除
     */
    public function formerEventsDelete($nowDate, $nowTime)
    {
        Event::where('date', '<=', $nowDate)->where('ending_time', '<=', $nowTime)->delete();
    }
}
