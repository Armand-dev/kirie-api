<?php

namespace App\Jobs;

use App\Services\Landlord\LeaseService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateLeasePDFJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected object $event
    )
    {}

    /**
     * Execute the job.
     */
    public function handle(LeaseService $leaseService): void
    {
        $filePath = $leaseService->generatePDF($this->event->lease);
        // TODO: send email
        // TODO: emit to socket
    }
}
