<?php

namespace OneThirtyOne\Sns\Tests\Fakes;

use OneThirtyOne\Sns\Concerns\SnsMessageInterface;

/**
 * Class MessageFake.
 */
class MessageFake implements SnsMessageInterface
{
    /**
     * @var array
     */
    public $type;

    /**
     * MessageFake constructor.
     *
     * @param array $type
     */
    public function __construct(array $type)
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function __get($property)
    {
        return $this->type['Type'];
    }
}
