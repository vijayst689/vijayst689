<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('payments:check-pending')
            ->cron('*/10 * * * *') // 0,10,20,30,40,50
            ->withoutOverlapping()
            ->runInBackground();

        $schedule->command('payments:check-ra-wallet')
            ->cron('2-59/10 * * * *') // 2,12,22,32,42,52
            ->withoutOverlapping()
            ->runInBackground();

        $schedule->command('server:auto-debit')
            ->monthlyOn(4, '00:05')
            ->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
