<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Lumen;

use App\Shared\Domain\Bus\Command\CommandBus as CommandBusInterface;
use App\Shared\Domain\Bus\Event\EventBus as EventBusInterface;
use App\Shared\Domain\Bus\Query\QueryBus as QueryBusInterface;
use App\Shared\Domain\UuidGenerator;
use App\Shared\Infrastructure\Bus\Messenger\MessengerCommandBus;
use App\Shared\Infrastructure\Bus\Messenger\MessengerEventBus;
use App\Shared\Infrastructure\Bus\Messenger\MessengerQueryBus;
use App\Shared\Infrastructure\RamseyUuidGenerator;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application;

final class SharedServiceProvider extends ServiceProvider
{
    public function register()
    {
        parent::register();

        $this->app->bind(
            EventBusInterface::class,
            function (Application $app) {
                return new MessengerEventBus($app->tagged('realworld.domain_event_subscriber'));
            }
        );

        $this->app->bind(
            QueryBusInterface::class,
            function (Application $app) {
                return new MessengerQueryBus($app->tagged('realworld.query_handler'));
            }
        );

        $this->app->bind(
            CommandBusInterface::class,
            function (Application $app) {
                return new MessengerCommandBus($app->tagged('realworld.command_handler'));
            }
        );

        $this->app->bind(
            UuidGenerator::class,
            RamseyUuidGenerator::class
        );
    }
}
