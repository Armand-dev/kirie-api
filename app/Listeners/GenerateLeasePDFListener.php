<?php

namespace App\Listeners;

use App\Services\LeaseService;
use Illuminate\Support\Facades\Log;

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
