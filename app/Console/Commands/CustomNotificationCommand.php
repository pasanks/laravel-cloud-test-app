<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CustomNotificationCommand extends Command
{
    protected $signature = 'app:custom-notification-command';
    protected $description = 'Send custom notifications';

    public function handle(): int
    {
        $this->info('Custom notification command executed at ' . now());

        return self::SUCCESS;
    }
}
