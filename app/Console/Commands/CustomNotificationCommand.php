<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CustomNotificationCommand extends Command
{
    protected $signature = 'app:custom-notification-command';
    protected $description = 'Send custom notifications';

    public function handle(): int
    {
        $message = 'Custom notification command executed at ' . now();
        Log::info($message);
        $this->info($message);

        return self::SUCCESS;
    }
}
