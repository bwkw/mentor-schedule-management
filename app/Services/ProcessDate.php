<?php

namespace App\Services;

use App\Models\Meeting;

/**
 * 日付情報加工/取得用クラス
 */
class ProcessDate
{
    /**
     * 曜日配列定義
     */
    private const WEEK = ['日', '月', '火', '水', '木', '金', '土'];
    
    /**
     * 曜日番号から曜日文字列を取得する。
     * 
     * @param int $weekNo 対象の曜日番号
     */
    public function dayOfTheWeek(int $weekNo)
    {
        return self::WEEK[$weekNo];
    }
}
