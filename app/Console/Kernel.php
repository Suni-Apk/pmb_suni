<?php

namespace App\Console;

use App\Jobs\BeforeTenggatJobs;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */

    protected $commands = [
        Commands\BeforeTenggat::class,
        Commands\Tenggat::class,
        Commands\AfterTenggat::class,
        Commands\Ipaymu::class,
    ];
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:before-tenggat')->everySecond();
        $schedule->command('app:tenggat')->dailyAt('21:32');
        $schedule->command('app:after-tenggat')->everySecond();
        $schedule->command('app:ipaymu')->everySecond();
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
