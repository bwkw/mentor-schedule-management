<?php

use App\Services\SlackPostReceive;
use Illuminate\Database\Seeder;

/**
 * Slackからメンター/生徒情報取得・DBに格納用シーダークラス
 */
class MentorStudentTableSeeder extends Seeder
{
    public function run(SlackPostReceive $slack)
    {
        // Slackチームのメンバーリスト取得（連想配列）
        $result = $slack->fetchSlackMemberList();
        
        // 取得したSlackチームのメンバーリストをメンターと生徒に分ける
        [$mentorSlackIdName, $studentSlackIdName] = $slack->splitMentorStudent($result);
        
        // mentorsテーブル、studentsテーブルの情報を削除
        DB::table('mentors')->truncate();
        DB::table('students')->truncate();
        
        // mentorsテーブルに情報を格納
        foreach ($mentorSlackIdName as $slackId => $slackName) {
            DB::table('mentors')->insert(
                ['slack_id' => $slackId,
                 'slack_name' => $slackName],
            );
        }
        
        // studentsテーブルに情報を格納
        foreach($studentSlackIdName as $slackId => $slackName) {
            DB::table('students')->insert(
                ['slack_id' => $slackId,
                 'slack_name' => $slackName],
            );
        }
    }
}
