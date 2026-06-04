<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('app:custom-notification-command')->everyMinute()->onOneServer();
Schedule::command('app:before-meeting-notification')->everyMinute()->onOneServer();
Schedule::command('app:before-schedule-notification')->everyMinute()->onOneServer();
Schedule::command('meetings:update-status')->hourly()->onOneServer();
