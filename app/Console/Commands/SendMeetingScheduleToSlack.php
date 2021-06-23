<?php

namespace App\Console\Commands;

use App\Models\Meeting;
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
        $headers = [
            'Authorization: Bearer xoxb-1970177030343-1998481059441-VOgMybEN6KBSc3X76FarwRR9',
            'Content-Type: application/json;charser¥t=ytf-8'
        ];
        
        $url = "https://slack.com/api/chat.postMessage";
        
        $now_date = date('Y-m-d');
        $meetings = Meeting::get();
        
        echo $meetings;
        // $send_fields = [
        //     "channel" => "general",
        //     ##"text" => "<!channel>\nテスト２",
        //     "text" => "<@U01UZBY4599>\nlaravelより送信"
        // ];
        
        // $options = [
        //     CURLOPT_URL => $url,
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_HTTPHEADER => $headers,
        //     CURLOPT_POST => true,
        //     CURLOPT_POSTFIELDS => json_encode($send_fields)
        // ];
        
        // $ch = curl_init();
        
        // curl_setopt_array($ch, $options);
        
        // $result = curl_exec($ch); 
        
        // curl_close($ch);
    }
}
