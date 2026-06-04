<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BeforeMeetingNotification extends Command
{
    protected $signature = 'app:before-meeting-notification';
    protected $description = 'Send before-meeting notifications';

    public function handle(): int
    {
        $this->info('Before meeting notification executed at ' . now());

        return self::SUCCESS;
    }
}
