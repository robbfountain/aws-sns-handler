<?php

namespace OneThirtyOne\Sns\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SnsEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The SNS Message.
     *
     * @var array
     */
    public $message;

    /**
     * Create and Event Instance.
     *
     * @param $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }
}
