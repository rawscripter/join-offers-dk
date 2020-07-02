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
//        PaymentReminder::class
        '\App\Console\Commands\PaymentReminder',
        '\App\Console\Commands\ProductReminderMail'
    ];

    /**
     * Define the applicatioon's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//        $schedule->command('payment:reminderMail')->daily();
        $schedule->command('payment:reminderMail')->daily();
        $schedule->command('mail:ProductReminderMail')->hourly();


    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
