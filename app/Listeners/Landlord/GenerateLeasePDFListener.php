<?php

namespace App\Listeners\Landlord;

use App\Services\Landlord\LeaseService;

class GenerateLeasePDFListener
{
    protected LeaseService $leaseService;

    /**
     * Create the event listener.
     */
    public function __construct(LeaseService $leaseService)
    {
        $this->leaseService = $leaseService;
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $filePath = $this->leaseService->generatePDF($event->lease);
        // TODO: send email
        // TODO: emit to socket
    }
}
