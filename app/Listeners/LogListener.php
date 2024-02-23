<?php

namespace App\Listeners;

use App\Events\LogEvent;
use App\Models\Log;

class LogListener
{
    /**
     * Handle the event.
     * 
     * @param  \Illuminate\Auth\Events\LogEvent  $event
     * @return void
     */
    public function handle(LogEvent $event): void
    {
        Log::create([
            'name' => $event->name,
            'room_num' => $event->room_num,
            'status' => $event->status,
        ]);
    }
}
