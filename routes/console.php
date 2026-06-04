<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('app:custom-notification-command')->everyMinute()->onOneServer()->appendOutputTo(storage_path('logs/scheduler.log'));
Schedule::command('app:before-meeting-notification')->everyMinute()->onOneServer()->appendOutputTo(storage_path('logs/scheduler.log'));
Schedule::command('app:before-schedule-notification')->everyMinute()->onOneServer()->appendOutputTo(storage_path('logs/scheduler.log'));
Schedule::command('meetings:update-status')->hourly()->onOneServer()->appendOutputTo(storage_path('logs/scheduler.log'));
