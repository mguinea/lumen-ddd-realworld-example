<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Lumen;

use App\Shared\Domain\Bus\Command\Command;
use App\Shared\Domain\Bus\Command\CommandBus as CommandBusInterface;
use Exception;
use Illuminate\Bus\Dispatcher;
use Laravel\Lumen\Application;

final class CommandBus implements CommandBusInterface
{
    private Dispatcher $commandBus;
    private Application $app;

    public function __construct(Dispatcher $commandBus, Application $app)
    {
        $this->commandBus = $commandBus;
        $this->app = $app;
    }

    public function dispatch(Command $command): void
    {
        $handler = $this->resolveHandler($command);
        $routing = $this->routingResolver($command);

        $job = (new CommandJob(
            $handler,
            $command
        ))
            ->onQueue($routing['queue'])
            ->delay($routing['delay'])
            ->onConnection($routing['connection']);

        try {
            $this->commandBus->dispatch($job);
        } catch (Exception $exception) {
            throw $exception->getPrevious() ?? $exception;
        }
    }

    private function resolveHandler(Command $command)
    {
        $commandClassName = get_class($command);
        $handlerClassName = $commandClassName . 'Handler';

        if (false === class_exists($handlerClassName)) {
            throw new CommandBusException('Handler ' . $handlerClassName . ' not found');
        }

        return $this->app->make($handlerClassName);
    }

    private function routingResolver(Command $command): array
    {
        $defaultConnection = $this->app->config['queue']['default'];
        $defaultQueue = 'default';
        $defaultDelay = 0;

        $commandClass = get_class($command);
        $routing = $this->app->config['queue']['routing'][$commandClass];

        if (null === $routing) {
            return [
                'connection' => $defaultConnection,
                'queue' => $defaultQueue,
                'delay' => $defaultDelay
            ];
        }

        return [
            'connection' => $routing['connection'] ?? $defaultConnection,
            'queue' => $routing['queue'] ?? $defaultQueue,
            'delay' => $routing['delay'] ?? $defaultDelay
        ];
    }
}
