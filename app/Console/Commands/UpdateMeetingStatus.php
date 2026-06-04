<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateMeetingStatus extends Command
{
    protected $signature = 'meetings:update-status';
    protected $description = 'Update meeting statuses';

    public function handle(): int
    {
        $this->info('Meeting status update executed at ' . now());

        return self::SUCCESS;
    }
}
