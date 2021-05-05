<?php

namespace Apps\BlogApi\App\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \Apps\BlogApi\App\Events\ExampleEvent::class => [
            \Apps\BlogApi\App\Listeners\ExampleListener::class,
        ],
    ];
}
