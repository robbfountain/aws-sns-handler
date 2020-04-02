<?php


namespace OneThirtyOne\Sns\Concerns;


use Aws\Sns\Message;

interface SnsValidatorInterface
{
    /**
     * Validate the incoming SNS Message
     *
     * @param \Aws\Sns\Message $message
     *
     * @return mixed
     */
    public function validate($message);
}
