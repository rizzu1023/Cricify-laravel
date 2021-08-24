<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class reverseHoldMatchEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $request;
    public $match;

    /**
     * Create a new event instance.
     *
     * @param $match
     * @param $request
     */
    public function __construct($match,$request)
    {
        $this->request = $request;
        $this->match = $match;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
