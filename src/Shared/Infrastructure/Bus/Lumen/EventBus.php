<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Lumen;

use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Bus\Event\EventBus as EventBusInterface;
use Illuminate\Bus\Dispatcher;
use Laravel\Lumen\Application;

final class EventBus implements EventBusInterface
{
    private Dispatcher $dispatcher;
    private Application $app;

    public function __construct(Dispatcher $dispatcher, Application $app)
    {
        $this->dispatcher = $dispatcher;
        $this->app = $app;
    }

    public function publish(DomainEvent ...$domainEvents): void
    {
        foreach ($domainEvents as $event) {
            $routing = $this->routingResolver($event);

            // TODO sqs connection $this->app->make('sns.connection')->publish('event', $event->toPrimitives());

            if ('sync' === $routing['connection']) {
                $listeners = $this->resolveListeners($event);

                foreach ($listeners as $listener) {
                    $job = (new EventJob(
                        $listener,
                        $event
                    ))
                        ->onQueue($routing['queue'])
                        ->delay($routing['delay'])
                        ->onConnection($routing['connection']);

                    $this->dispatcher->dispatch($job);
                }
            }
        }
    }

    private function routingResolver(DomainEvent $event): array
    {
        $defaultConnection = $this->app->config['queue']['default'];
        $defaultQueue = 'default';
        $defaultDelay = 0;

        $eventClass = get_class($event);
        $routing = $this->app->config['queue']['routing'][$eventClass];

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

    private function resolveListeners(DomainEvent $event): array
    {
        $eventClass = get_class($event);
        $listenerClasses = $this->app->config['events'][$eventClass] ?? [];
        $listeners = [];

        foreach ($listenerClasses as $listenerClass) {
            if (false === class_exists($listenerClass)) {
                throw new \Exception('Listener ' . $listenerClass . ' not found');
            }

            $listeners[] = $this->app->make($listenerClass);
        }

        return $listeners;
    }
}
