<?php

declare(strict_types=1);

namespace App\Blog\Article\Domain;

use App\Shared\Domain\Bus\Event\DomainEvent;

final class ArticleWasUpdated extends DomainEvent
{
    public function fromPrimitives(string $aggregateId, array $body, string $eventId, string $occurredOn): DomainEvent
    {
        // TODO: Implement fromPrimitives() method.
    }

    public function eventName(): string
    {
        // TODO: Implement eventName() method.
    }

    public function toPrimitives(): array
    {
        // TODO: Implement toPrimitives() method.
    }
}
