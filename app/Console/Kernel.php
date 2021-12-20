<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('blueprint:purchases')
            ->weekdays()
            ->hourly()
            ->timezone('America/Moncton')
            ->between('8:00', '18:00');


        $schedule->command('blueprint:engineering-digest')
            ->weekdays()
            ->dailyAt('8:00')
            ->timezone('America/Moncton');


        $schedule->command('blueprint:clock-out')
            ->dailyAt('20:00')
            ->timezone('America/Moncton');


        $schedule->command('queue:prune-batches')
            ->dailyAt('19:00')
            ->timezone('America/Moncton');


        $schedule->command('queue:flush')
            ->dailyAt('19:10')
            ->timezone('America/Moncton');
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
