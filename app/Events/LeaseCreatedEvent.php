<?php

namespace App\Events;

use App\Models\Lease;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
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
