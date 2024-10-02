<?php

namespace App\Console;

use App\Jobs\Sdm\Skor\HitungSkor;
use App\Jobs\Sdm\SynchronizeSpreadsheetRespon;
use App\Jobs\Sdm\SynchronizeSpreadsheetUser;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        // $schedule
        //     ->job(new SynchronizeSpreadsheetUser, 'SynchronizeSpreadsheetUser', 'redis')
        //     ->withoutOverlapping()
        //     ->onOneServer()
        //     ->everySixHours();
        // $schedule
        //     ->job(new SynchronizeSpreadsheetRespon, 'SynchronizeSpreadsheetRespon', 'redis')
        //     ->withoutOverlapping()
        //     ->onOneServer()
        //     ->everyMinute();
        // $schedule
        //     ->job(new HitungSkor, 'hitung-skor', 'redis')
        //     ->withoutOverlapping()
        //     ->onOneServer()
        //     // ->everyMinute();
        //     ->everySixHours();

        // ->everySixHours();
        // ->appendOutputTo(storage_path('logs/jobs/sync.log'))
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
