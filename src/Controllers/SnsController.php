<?php

namespace OneThirtyOne\Sns\Controllers;

use Aws\Sns\Exception\InvalidSnsMessageException;
use Illuminate\Support\Facades\Http;
use OneThirtyOne\Sns\Concerns\SnsMessageInterface;
use OneThirtyOne\Sns\Concerns\SnsValidatorInterface;
use OneThirtyOne\Sns\Events\SnsEvent;
use OneThirtyOne\Sns\Events\SnsSubscriptionConfirmation;

/**
 * Class SnsController.
 */
class SnsController
{
    /**
     * @var \OneThirtyOne\Sns\Concerns\SnsMessageInterface
     */
    protected $message;

    /**
     * @var \OneThirtyOne\Sns\Concerns\SnsValidatorInterface
     */
    protected $validator;

    /**
     * @var array
     */
    protected $confirmation = [
        'SubscriptionConfirmation',
    ];

    /**
     * @var array
     */
    protected $notification = [
        'Notification',
    ];

    /**
     * SnsController constructor.
     *
     * @param \OneThirtyOne\Sns\Concerns\SnsMessageInterface   $message
     * @param \OneThirtyOne\Sns\Concerns\SnsValidatorInterface $validator
     */
    public function __construct(SnsMessageInterface $message, SnsValidatorInterface $validator)
    {
        $this->message = $message;
        $this->validator = $validator;
    }

    /**
     * Handle the HTTP Request from SNS Service.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function handle()
    {
        try {
            $this->validator->validate($this->message->get());
        } catch (InvalidSnsMessageException $e) {
            return response('SNS Message Validation Error: '.$e->getMessage(), 404);
        }

        if (in_array($this->message->Type, $this->confirmation)) {
            $response = Http::get($this->message->SubscribeURL);

            if ($response->ok()) {
                SnsSubscriptionConfirmation::dispatch($this->message);
            }

            return response('OK', 200);
        }

        if (in_array($this->message->Type, $this->notification)) {
            SnsEvent::dispatch($this->message);
        }

        return response('OK', 200);
    }
}
