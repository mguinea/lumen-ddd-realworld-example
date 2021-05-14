<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Event\Symfony;

use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Bus\Event\EventBus;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

final class InMemorySymfonyEventBus implements EventBus
{
    private MessageBusInterface $eventBus;

    public function __construct(MessageBusInterface $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function publish(DomainEvent ...$domainEvents): void
    {
        foreach ($domainEvents as $event) {
            $this->eventBus->dispatch(new Envelope($event));
        }
    }
}
