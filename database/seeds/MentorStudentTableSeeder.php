<?php

use Illuminate\Database\Seeder;

class MentorStudentTableSeeder extends Seeder
{
    // Slackからidとnameを取得し、メンターと生徒を区別
    // mentors table（メンター情報格納テーブル）とstudents table（生徒情報格納テーブル）に格納
     public function run()
    {
        // Slack APIを叩いてslackチームのユーザーリストを取得
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
        
        $ch = curl_init();
        
        curl_setopt_array($ch, $options);
        
        $result = curl_exec($ch); 
        
        curl_close($ch);
        
        // curlでAPIを呼び出し、返ってきたjsonデータを日本語にする
        $unicode_decode_json = json_encode(json_decode($result), JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
        
        // 正規表現でid、real_name(slackで表示されている名前)を取得
        preg_match_all('/"id": "(?P<slack_id>[A-Z0-9]+)"/', $unicode_decode_json, $slack_id_match);
        preg_match_all('/"skype": "",\s*"real_name": "(?P<real_name>.*)"/', $unicode_decode_json, $real_name_match);
        preg_match_all('/"display_name": "(?P<slack_display_name>.*)"/', $unicode_decode_json, $slack_display_name_match);
        
        $slack_id_name_list = [];
        for ($i = 0; $i < (count($slack_id_match["slack_id"])); $i++) {
            $slack_id_match_item = $slack_id_match["slack_id"][$i];
            $real_name_match_item = $real_name_match["real_name"][$i];
            $slack_display_name_match_item = $slack_display_name_match["slack_display_name"][$i];
            if(($slack_display_name_match_item)==""){
                $slack_id_name_list[$slack_id_match_item] = $real_name_match_item;
            }
            else{
                $slack_id_name_list[$slack_id_match_item] = $slack_display_name_match_item;
            }
        }
        
        // 全体の連想配列からメンター、生徒の連想配列に分解
        $mentor_slack_id_name_list = [];
        $student_slack_id_name_list = [];
        foreach ($slack_id_name_list as $slack_id => $slack_name) {
            if((strstr($slack_name,'(メンター)')) or (strstr($slack_name,'（メンター）'))){
                // 特定の文字（メンター）を消し、名前だけを抽出
                $slack_name = str_replace('(メンター)', '', $slack_name);
                $slack_name = str_replace('（メンター）', '', $slack_name);
                $mentor_slack_id_name_list[$slack_id] = $slack_name;
            }
            elseif((strstr($slack_name,'（')==false) and (strstr($slack_name,'(')==false) and ($slack_name!="") and ($slack_name!="Slackbot")){
                $student_slack_id_name_list[$slack_id] = $slack_name;
            }
        }
        
        // mentorsテーブル、studentsテーブルの情報を削除
        DB::table('mentors')->truncate();
        DB::table('students')->truncate();
        
        // mentorsテーブルに値を格納
        foreach($mentor_slack_id_name_list as $slack_id => $slack_name) {
            DB::table('mentors')->insert(
                ['slack_id' => $slack_id,
                 'slack_name' => $slack_name],
            );
        }
        
        //studentsテーブルに値を格納
        foreach($student_slack_id_name_list as $slack_id => $slack_name) {
            DB::table('students')->insert(
                ['slack_id' => $slack_id,
                 'slack_name' => $slack_name],
            );
        }
    }
}
