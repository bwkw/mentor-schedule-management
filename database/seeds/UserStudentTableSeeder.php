<?php

use Illuminate\Database\Seeder;

class UserStudentTableSeeder extends Seeder
{
    // Slackからidとnameを取得し、メンターと生徒を区別
    // users table(メンター)とstudents table（生徒）に格納（アプリ利用者をメンターとして想定しているため）
     public function run()
    {
        // Slack APIを叩く（curlを利用）
        $headers = [
        'Authorization: Bearer '.config('app.slack_member_list'),
        'Content-Type: application/json;charser¥t=ytf-8'
        ];
        
        $url = "https://slack.com/api/users.list";
        
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POST => true,
        ];
        
        $ch = curl_init();
        
        curl_setopt_array($ch, $options);
        
        $result = curl_exec($ch); 
        
        curl_close($ch);
        
        // curlでAPIを呼び出し、返ってきたjsonデータを日本語にする
        $unicode_decode_json = json_encode(json_decode($result), JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
        
        //正規表現でid、display_name(slackで表示されている名前)を取得する
        preg_match_all('/"id": "(?P<slack_id>[A-Z0-9]+)"/', $unicode_decode_json, $slack_id_match);
        preg_match_all('/"display_name": "(?P<slack_name>.*)"/', $unicode_decode_json, $slack_name_match);
        
        //空配列を用意し、その空配列にslack_id、slack_nameを格納していく
        $slack_id_list = [];
        array_push($slack_id_list, $slack_id_match["slack_id"]);
        $slack_name_list = [];
        array_push($slack_name_list, $slack_name_match["slack_name"]);
        
        //slackチームに入っている人のid,slacknameを連想配列にする
        $slack_id_name_list = array_combine($slack_id_list[0], $slack_name_list[0]);
        
        //全体の連想配列からメンター、生徒の連想配列に分解
        $mentor_slack_id_name_list = [];
        $student_slack_id_name_list = [];
        foreach ($slack_id_name_list as $slack_id => $slack_name) {
            if(strstr($slack_name,'メンター')){
                // 特定の文字（メンター）を消し、名前だけを抽出する
                $slack_name = str_replace('(メンター)', '', $slack_name);
                $slack_name = str_replace('（メンター）', '', $slack_name);
                $mentor_slack_id_name_list[$slack_id] = $slack_name;
            }
            elseif((strstr($slack_name,'メンター')==false) and ($slack_name!="") and ($slack_name!="Slackbot")){
                $student_slack_id_name_list[$slack_id] = $slack_name;
            }
        }
        
        //一度mentorsテーブル、studentsテーブルを初期化
        DB::table('mentors')->truncate();
        DB::table('students')->truncate();
        
        // usersテーブルに値を格納していく
        foreach($mentor_slack_id_name_list as $slack_id => $slack_name) {
            DB::table('mentors')->insert(
                ['slack_id' => $slack_id,
                 'slack_name' => $slack_name],
            );
        }
        
        //studentsテーブルに値を格納していく
        foreach($student_slack_id_name_list as $slack_id => $slack_name) {
            DB::table('students')->insert(
                ['slack_id' => $slack_id,
                 'slack_name' => $slack_name],
            );
        }
    }
}
