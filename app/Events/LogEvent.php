<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LogEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $name, $room_num, $status;

    /**
     * Create a new event instance.
     */
    public function __construct($name, $room_num, $status)
    {
        $this->name = $name;
        $this->room_num = $room_num;
        $this->status = $status;
    }
}
