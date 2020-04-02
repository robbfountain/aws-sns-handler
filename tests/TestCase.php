<?php

namespace OneThirtyOne\Sns\Tests;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;
use OneThirtyOne\Sns\SnsServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Setup.
     */
    public function setUp(): void
    {
        parent::setUp();

        Event::fake();
        Http::fake();
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [SnsServiceProvider::class];
    }
}
