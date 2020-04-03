<?php

namespace OneThirtyOne\Sns\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SnsSubscriptionConfirmation
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create and Event Instance.
     *
     * @param $message
     */
    public function __construct()
    {
        //
    }
}
