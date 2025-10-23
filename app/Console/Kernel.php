<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Process queue every minute
        $schedule->command('queue:work --stop-when-empty --tries=3')->everyMinute()->withoutOverlapping();

        // Health check daily at midnight
        $schedule->command('health:check')->everyMinute();
        // $schedule->command('inspire')->hourly();

        // Run daily at 9:00 AM
        $schedule->command('app:send-low-stock-alerts')->dailyAt('09:00')->appendOutputTo(storage_path('logs/scheduler.log'));
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
