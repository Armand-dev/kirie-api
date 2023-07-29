<?php

namespace App\Listeners\Landlord;

use App\Jobs\GenerateLeasePDFJob;
use App\Models\Landlord\Lease;
use App\Services\Landlord\LeaseService;

class GenerateLeasePDFListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {}

    /**
     * @param object{lease: Lease} $event
     * @return void
     */
    public function handle(object $event): void
    {
        GenerateLeasePDFJob::dispatch($event);
    }
}
