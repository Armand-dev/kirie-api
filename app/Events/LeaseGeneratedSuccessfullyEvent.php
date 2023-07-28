<?php

namespace App\Events;

use App\Models\Landlord\Lease;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LeaseGeneratedSuccessfullyEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Lease $lease;

    /**
     * Create a new event instance.
     */
    public function __construct(Lease $lease)
    {
        $this->lease = $lease;
        $this->user = $lease->user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return PrivateChannel
     */
    public function broadcastOn()
    {
        return new PrivateChannel('leases.' . $this->user->id);
    }
}
