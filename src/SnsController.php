<?php


namespace OneThirtyOne\Sns;


use Aws\Sns\Exception\InvalidSnsMessageException;
use Aws\Sns\Message;
use Aws\Sns\MessageValidator;
use Illuminate\Support\Facades\Http;
use OneThirtyOne\Sns\Events\SnsEvent;
use OneThirtyOne\Sns\Events\SnsSubscriptionConfirmation;

class SnsController
{
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
     * Handle the HTTP Request from SNS Service
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function handle()
    {
        $message = Message::fromRawPostData();

        $validator = new MessageValidator();

        try {
            $validator->validate($message);
        } catch (InvalidSnsMessageException $e) {
            return response('SNS Message Validation Error: ' . $e->getMessage(), 404);
        }

        if (in_array($message['Type'], $this->confirmation)) {
            $response = Http::get($message['SubscribeURL']);

            if ($response->ok()) {
                SnsSubscriptionConfirmation::dispatch($message);
            }

            return response('OK', 200);
        }

        if (in_array($message['Type'], $this->notification)) {
            SnsEvent::dispatch($message);
        }

        return response('OK', 200);
    }
}
