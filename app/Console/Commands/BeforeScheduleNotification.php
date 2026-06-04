<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BeforeScheduleNotification extends Command
{
    protected $signature = 'app:before-schedule-notification';
    protected $description = 'Send before-schedule notifications';

    public function handle(): int
    {
        $this->info('Before schedule notification executed at ' . now());

        return self::SUCCESS;
    }
}
