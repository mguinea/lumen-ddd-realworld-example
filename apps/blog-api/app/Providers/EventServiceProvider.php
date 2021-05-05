<?php

namespace Apps\BlogApi\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \Apps\BlogApi\Events\ExampleEvent::class => [
            \Apps\BlogApi\Listeners\ExampleListener::class,
        ],
    ];
}
