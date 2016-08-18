<?php

namespace App\Events;

use App\Events\Event;
use App\Order;
use App\User;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class UserPlacedAnOrder extends Event
{
    use SerializesModels;

    public $user;

    public $order;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Order $order)
    {
        $this->user = $user;
        $this->order = $order;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
