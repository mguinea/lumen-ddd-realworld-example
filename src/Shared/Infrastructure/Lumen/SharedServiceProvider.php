<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Lumen;

use App\Shared\Domain\Bus\Command\CommandBus as CommandBusInterface;
use App\Shared\Domain\Bus\Event\EventBus as EventBusInterface;
use App\Shared\Domain\Bus\Query\QueryBus as QueryBusInterface;
use App\Shared\Infrastructure\Bus\Lumen\CommandBus;
use App\Shared\Infrastructure\Bus\Lumen\EventBus;
use App\Shared\Infrastructure\Bus\Lumen\QueryBus;
use Illuminate\Support\ServiceProvider;

final class SharedServiceProvider extends ServiceProvider
{
    public function register()
    {
        parent::register();

        $this->app->bind(
            EventBusInterface::class,
            EventBus::class
        );

        $this->app->bind(
            QueryBusInterface::class,
            QueryBus::class
        );

        $this->app->bind(
            CommandBusInterface::class,
            CommandBus::class
        );
    }
}
