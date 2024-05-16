<?php

namespace App\Jobs;

use App\Models\ListingPlatform;
use App\Models\User;
use App\Services\Landlord\OlxListingService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchOlxListingStats implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->queue = 'olx';
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $olxService = new OlxListingService();

        User::whereHas('listingPlatforms')->each(function (User $user) use ($olxService) {
            foreach ($user->listings()->onPlatform(ListingPlatform::OLX)->get() as $listing) {
                if ($listing->platform_id) {
                    try {
                        $olxService->fetchStats($user, $listing);
                    } catch (\Exception $exception) {
                        continue;
                    }
                }
            }
        });
    }
}
