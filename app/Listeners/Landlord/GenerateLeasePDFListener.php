<?php

namespace App\Listeners\Landlord;

use App\Jobs\GenerateLeasePDFJob;
use App\Services\Landlord\LeaseService;

class GenerateLeasePDFListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {}

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        GenerateLeasePDFJob::dispatch($event);
    }
}
