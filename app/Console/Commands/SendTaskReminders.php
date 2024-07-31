<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendTaskReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:remind';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email reminders for tasks due in 2 days';

    /**
     * Execute the console command.
     */

     public function __construct()
         {
             parent::__construct();
         }
     public function handle()
        {
            $today = Carbon::today();
            $tasks = Task::whereDate('completed_at', $today)->get();

            if ($tasks->isEmpty()) {
                $this->info('No tasks completed today.');
                return;
            }

            Mail::to('recipient@example.com')->send(new DailyTaskReport($tasks));
            $this->info('Daily task report sent successfully.');
        }
}
