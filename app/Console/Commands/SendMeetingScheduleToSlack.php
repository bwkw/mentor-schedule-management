<?php

namespace App\Console\Commands;

use App\Models\Meeting;
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
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        $now_date = date('Y-m-d');
        
        // 今日の曜日を取得
        $week = [
            '日', // 0
            '月', // 1
            '火', // 2
            '水', // 3
            '木', // 4
            '金', // 5
            '土', // 6
        ];
        $now_day_of_the_week = $week[date('w')];
        
        $meetings = Meeting::get();
        
        // meetingsテーブルから今日の日付と一致するものを取得
        $today_meetings = Meeting::where('date', '=', $now_date) -> get();
        
        // slackに送るテキスト
        $text="*".date('m/d')."（".$now_day_of_the_week."）"."の面談予定*\n\n";
        foreach($today_meetings as $today_meeting)
        {
            $student_name = $today_meeting->student_name;
            $mentor_name = $today_meeting->student_name;
            $student_slack_id = Student::where('slack_name', '=', $student_name) -> value('slack_id');
            $beginning_time = $today_meeting->beginning_time;
            $ending_time = $today_meeting->ending_time;
            $text = $text."<@".$student_slack_id.">\n".$beginning_time."〜".$ending_time."\n";
        }
        
        // S
        $headers = [
            'Authorization: Bearer xoxb-1970177030343-1998481059441-VOgMybEN6KBSc3X76FarwRR9',
            'Content-Type: application/json;charser¥t=ytf-8'
        ];
        
        $url = "https://slack.com/api/chat.postMessage";
        
        $send_fields = [
                "channel" => "general",
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
        
        $ch = curl_init();
        
        curl_setopt_array($ch, $options);
        
        $result = curl_exec($ch); 
        
        // curl_close($ch);
    }
}
