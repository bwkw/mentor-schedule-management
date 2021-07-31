<?php

namespace App\Services;

use App\Models\Meeting;
use App\Models\Mentor;
use App\Models\Student;
use App\Services\ProcessDate;

/**
 * Slackとの送受信用クラス
 */
class SlackPostReceive
{
    /**
     * Slackチームのメンバーリストを連想配列で取得する
     */
    public function fetchSlackMemberlist()
    {
        // Slack APIを叩いてSlackチームのユーザーリストを取得
        $headers = [
            'Authorization: Bearer '. config('app.slack_member_list'),
            'Content-Type: application/json;charser¥t=ytf-8'
        ];
        
        $url = "https://slack.com/api/users.list";
        
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POST => true,
        ];
        
        // 実行処理
        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        curl_close($ch);
        
        // 文字列をデコードして連想配列に
        $result = json_decode($result, true);
        
        return $result;
    }
    
    /**
     * Slackチームのメンバーリストをメンターと生徒に分ける
     */
    public function splitMentorStudent($result)
    {
        // Slackチームに所属している全員の情報を{id:name}の連想配列に
        $slackIdName = [];
        $slackMember = $result["members"];
        for ($i = 0; $i < count($slackMember); $i++) {
            $slackId = $slackMember[$i]["id"];
            $realName = $slackMember[$i]["profile"]["real_name"];
            $displayName = $slackMember[$i]["profile"]["display_name"];
        
            // メンターは、$displayNameに「氏名（メンター）」という情報が格納されている
            // $displayNameがない人（slackで名前の表示を変えていない人）の名前は、$realNameに格納されている
            if ($displayName != "") {
                $slackIdName[$slackId] = $displayName;
            } else {
                $slackIdName[$slackId] = $realName;
            }
        }
        
        // 全体の連想配列からメンターと生徒の連想配列に分解
        $mentorSlackIdName = [];
        $studentSlackIdName = [];
        $mentor1 = "(メンター)";
        $mentor2 = "（メンター）";
        foreach ($slackIdName as $slackId => $slackName) {
            if (strstr($slackName, $mentor1)) {
                $slackName = str_replace($mentor1, '', $slackName);
                $mentorSlackIdName[$slackId] = $slackName;
            } elseif (strstr($slackName, $mentor2)) {
                $slackName = str_replace($mentor2, '', $slackName);
                $mentorSlackIdName[$slackId] = $slackName;
            } else {
                $studentSlackIdName[$slackId] = $slackName;
            }
        }
        
        return [$mentorSlackIdName, $studentSlackIdName];
    }
}