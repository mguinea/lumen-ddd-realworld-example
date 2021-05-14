<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Lumen;

use App\Shared\Domain\Bus\Event\EventBus;
use App\Shared\Infrastructure\Bus\Event\Symfony\InMemorySymfonyEventBus;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\MessageBusInterface;

final class SharedServiceProvider extends ServiceProvider
{
    public function register()
    {
        parent::register();

        $this->app->bind(
            EventBus::class,
            InMemorySymfonyEventBus::class
        );

        $this->app->bind(
            MessageBusInterface::class,
            MessageBus::class
        );
    }
}
