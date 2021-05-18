<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Lumen;

use App\Shared\Domain\Bus\Query\Query;
use App\Shared\Domain\Bus\Query\QueryBus as QueryBusInterface;
use App\Shared\Domain\Bus\Query\Response;
use Exception;
use Illuminate\Bus\Dispatcher;
use Laravel\Lumen\Application;

final class QueryBus implements QueryBusInterface
{
    private Dispatcher $queryBus;
    private Application $app;

    public function __construct(Dispatcher $queryBus, Application $app)
    {
        $this->queryBus = $queryBus;
        $this->app = $app;
    }

    public function ask(Query $query): ?Response
    {
        $handler = $this->resolveHandler($query);
        $routing = $this->routingResolver($query);

        $job = (new QueryJob(
            $handler,
            $query
        ))
            ->onQueue($routing['queue'])
            ->delay($routing['delay'])
            ->onConnection($routing['connection']);

        try {
            return $this->queryBus->dispatch($job);
        } catch (Exception $exception) {
            throw $exception->getPrevious() ?? $exception;
        }
    }

    private function resolveHandler(Query $query)
    {
        $queryClassName = get_class($query);
        $handlerClassName = $queryClassName . 'Handler';

        if (false === class_exists($handlerClassName)) {
            throw new QueryBusException('Handler ' . $handlerClassName . ' not found');
        }

        return $this->app->make($handlerClassName);
    }

    private function routingResolver(Query $query): array
    {
        $defaultConnection = $this->app->config['queue']['default'];
        $defaultQueue = 'default';
        $defaultDelay = 0;

        $queryClass = get_class($query);
        $routing = $this->app->config['queue']['routing'][$queryClass];

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
