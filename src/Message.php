<?php

namespace OneThirtyOne\Sns;

use OneThirtyOne\Sns\Concerns\SnsMessageInterface;

/**
 * Class Message.
 */
class Message implements SnsMessageInterface
{
    /**
     * @var \Aws\Sns\Message
     */
    protected $message;

    /**
     * Message constructor.
     */
    public function __construct()
    {
        $this->message = \Aws\Sns\Message::fromRawPostData();
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        return $this->message;
    }

    /**
     * {@inheritdoc}
     */
    public function __get($property)
    {
        return $this->message[$property];
    }
}
