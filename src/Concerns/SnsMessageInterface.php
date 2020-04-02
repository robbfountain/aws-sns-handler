<?php

namespace OneThirtyOne\Sns\Concerns;

interface SnsMessageInterface
{
    /**
     * Get an instance of an SNS Message.
     *
     * @return \Aws\Sns\Message
     */
    public function get();

    /**
     * Get a message Property.
     *
     * @param $property
     *
     * @return mixed
     */
    public function __get($property);
}
