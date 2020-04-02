<?php

namespace OneThirtyOne\Sns;

use Illuminate\Support\ServiceProvider;
use OneThirtyOne\Sns\Concerns\SnsMessageInterface;
use OneThirtyOne\Sns\Concerns\SnsValidatorInterface;

class SnsServiceProvider extends ServiceProvider
{

    /**
     * Register the Service Provider
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SnsMessageInterface::class, Message::class);
        $this->app->bind(SnsValidatorInterface::class, Validator::class);
    }

    /**
     * Boot the Service Provider
     *
     * @return void
     */
    public function boot()
    {
        //
    }

}
