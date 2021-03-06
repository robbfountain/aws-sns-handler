<?php

namespace OneThirtyOne\Sns;

use Aws\Sns\MessageValidator;
use OneThirtyOne\Sns\Concerns\SnsValidatorInterface;

/**
 * Class Validator.
 */
class Validator implements SnsValidatorInterface
{
    /**
     * @var \Aws\Sns\MessageValidator
     */
    protected $validator;

    /**
     * Validator constructor.
     */
    public function __construct()
    {
        $this->validator = new MessageValidator();
    }

    /**
     * {@inheritdoc}
     */
    public function validate($message)
    {
        $this->validator->validate($message);
    }
}
