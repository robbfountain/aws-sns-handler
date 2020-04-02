<?php

namespace OneThirtyOne\Sns\Tests;

use Illuminate\Support\Facades\Event;
use OneThirtyOne\Sns\Controllers\SnsController;
use OneThirtyOne\Sns\Events\SnsEvent;
use OneThirtyOne\Sns\Events\SnsSubscriptionConfirmation;
use OneThirtyOne\Sns\Tests\Fakes\MessageFake;
use OneThirtyOne\Sns\Validator;

class SnsHandlerTest extends TestCase
{
    /** @test */
    public function it_fires_an_event_when_receiving_an_sns_request()
    {
        $mockValidator = $this->mock(Validator::class);
        $mockValidator->shouldReceive('validate')->once();

        $handler = new SnsController(new MessageFake(['Type' => 'Notification']), $mockValidator);
        $handler->handle();

        Event::assertDispatched(SnsEvent::class);
    }

    /** @test */
    public function it_fires_an_event_when_validating_an_sns_request()
    {
        $mockValidator = $this->mock(Validator::class);
        $mockValidator->shouldReceive('validate')->once();

        $handler = new SnsController(new MessageFake(['Type' => 'SubscriptionConfirmation']), $mockValidator);
        $handler->handle();

        Event::assertDispatched(SnsSubscriptionConfirmation::class);
    }
}
