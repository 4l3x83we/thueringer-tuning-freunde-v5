<?php

namespace App\Console;

use Dymantic\InstagramFeed\Profile;
use Exception;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('create:monthly-payment')->daily();
        $schedule->command('generate:sitemap')->daily();
        $schedule->command('email:inactive-users')->weekly()->sundays();
        $schedule->call(function () {
            try {
                Profile::where('username', 'tuning_freunde')->first()->refreshFeed(12);
            } catch (Exception $e) {
                Log::error('Beim Abrufen des Instagram-Feeds ist ein Fehler aufgetreten', ['message' => $e->getMessage()]);
            }
        })->twiceDaily();
        $schedule->command('instagram-feed:refresh-tokens')->monthlyOn(15, '03:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
