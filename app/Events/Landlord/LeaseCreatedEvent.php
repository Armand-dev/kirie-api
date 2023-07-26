<?php

namespace App\Events\Landlord;

use App\Models\Landlord\Lease;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LeaseCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Lease $lease;

    /**
     * Create a new event instance.
     */
    public function __construct(Lease $lease)
    {
        $this->lease = $lease;
    }
}
