<?php

namespace App\Console;

use App\Jobs\FetchOlxListings;
use App\Jobs\FetchOlxListingStats;
use App\Jobs\GetListingServicesCategoriesJob;
use App\Jobs\RentTransactionJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
         $schedule->job(new RentTransactionJob())->dailyAt('5:00');
//         $schedule->job(new GetListingServicesCategoriesJob())->weeklyOn(1, '00:00'); KEEP DISABLED

        /** OLX Jobs */
        $schedule->job(new FetchOlxListingStats())->hourly();
        $schedule->job(new FetchOlxListings())->hourly();

        /** ... */
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
