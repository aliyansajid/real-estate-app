<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunScheduledTasks extends Command
{
    protected $signature = 'tasks:run';
    protected $description = 'Run scheduled tasks at a defined interval without cron';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Starting task runner...');

        while (true) {
            // Trigger your commands here
            $this->call('listings:send-expiry-emails');
            $this->call('listings:update-expired');

            $this->info('Tasks executed at ' . now());

            // Wait for 5 minutes
            sleep(300); // 300 seconds = 5 minutes
        }
    }
}
