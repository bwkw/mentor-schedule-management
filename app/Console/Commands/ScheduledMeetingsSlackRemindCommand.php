<?php

namespace App\Console\Commands;

use App\Models\Meeting;
use App\Models\Mentor;
use App\Models\Student;
use App\Services\ProcessDate;
use App\Services\SlackPostReceive;
use Illuminate\Console\Command;

/**
 * 面談予定Slackリマインド用コマンドクラス
 */
class ScheduledMeetingsSlackRemindCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ScheduledMeetingsSlackRemind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'remind slack of scheduled meetings';

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
    public function handle(ProcessDate $date, Meeting $meeting, Mentor $mentor, SlackPostReceive $slack, Student $student)
    {
        // Slackに送信するテキストを作成
        $text = $slack->createSlackText($date, $meeting, $mentor, $student);
        
        // テキストをSlackに送信
        $slack->postSlackMessage($text);
    }
}
