<?php

namespace App\Console\Commands;

use App\Models\Meeting;
use App\Models\Mentor;
use App\Models\Student;
use Illuminate\Console\Command;

class SendMeetingScheduleToSlack extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendMeetingScheduleToSlack';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    // 曜日を取得する関数
    public function day_of_the_week($w){
        $Week = array(
            '日',//0
            '月',//1
            '火',//2
            '水',//3
            '木',//4
            '金',//5
            '土'//6
        );
        return $Week[$w];
    }
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        $now_date = date('Y-m-d');
        
        $now_day_of_the_week = $this->day_of_the_week(date('w'));
        
        // slackに送るテキスト
        $text="*".date('m/d')."（".$now_day_of_the_week."）"."の面談予定*\n";
        
        $mentors = Mentor::get();
        
        foreach($mentors as $mentor)
        {
            $mentor_name = $mentor -> slack_name;
            $today_meetings_for_a_mentor = Meeting::where('date', '=', $now_date) -> where('mentor_name', '=', $mentor_name) -> orderBy('beginning_time') -> get();
            if (count($today_meetings_for_a_mentor) == 0) {
                $text = $text;
            } else {
                $text = $text."\n"."■".$mentor_name."との面談者\n";
                foreach ($today_meetings_for_a_mentor as $today_meeting_for_a_mentor) {
                    $student_name = $today_meeting_for_a_mentor -> student_name;
                    $student_slack_id = Student::where('slack_name', '=', $student_name) -> value('slack_id');
                    $how_to_meeting = $today_meeting_for_a_mentor -> how_to;
                    $beginning_time = $today_meeting_for_a_mentor -> beginning_time;
                    $ending_time = $today_meeting_for_a_mentor -> ending_time;
                    $text = $text."<@".$student_slack_id.">\t".substr($beginning_time, 0, strlen($beginning_time)-3) . "〜" . substr($ending_time, 0, strlen($ending_time)-3)."\t".$how_to_meeting."\n";
                }
            }
        }
        
        // もし面談者がいない場合のslackに送るテキスト
        if(strpos($text,"との面談者") == false){
            $text = $text."本日の面談予定はありません";
        }
        
        // Slack APIを叩いてslackチームにメッセージを送信
        $headers = [
            'Authorization: Bearer '. config('app.slack_post_message'),
            'Content-Type: application/json;charser¥t=ytf-8'
        ];
        
        $url = "https://slack.com/api/chat.postMessage";
        
        $send_fields = [
                "channel" => "面談リマインド",
                ##"text" => "<!channel>\nテスト２",
                "text" => $text
            
        ];
        
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($send_fields)
        ];
        
        // 実行処理
        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch); 
        curl_close($ch);
    }
}
