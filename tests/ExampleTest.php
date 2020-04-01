<?php

namespace OneThirtyOne\Sns\Tests;

use Aws\Sns\Message;
use Aws\Sns\MessageValidator;
use Mockery;
use OneThirtyOne\Sns\SnsController;

class ExampleTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function example_test()
    {
        $service = Mockery::mock('alias:Aws\Sns\Message');
        $service->shouldReceive('fromRawPostData');

        $validator = Mockery::mock(MessageValidator::class);
        $validator->shouldReceive('validate')->with($this->snsConfirmation())->andReturn(true);

        $handler = new SnsController();
        $handler->handle();
    }

    public function snsConfirmation()
    {
        return new Message();
    }
}
