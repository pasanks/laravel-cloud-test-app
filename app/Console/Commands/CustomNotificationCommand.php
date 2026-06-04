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
        Log::info('app:custom-notification-command ran', ['timestamp' => now()->toIso8601String()]);
        $this->info('Custom notification command executed at ' . now());

        return self::SUCCESS;
    }
}
