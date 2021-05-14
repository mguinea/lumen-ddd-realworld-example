<?php

declare(strict_types=1);

namespace App\Blog\User\Domain;

final class UserWasCreated extends UserDomainEvent
{
    public function getEventName(): string
    {
        return 'blog.user.was_created';
    }

    public function fromPrimitives(string $aggregateId, array $body, string $eventId, string $occurredOn): array
    {
        // TODO: Implement fromPrimitives() method.
    }

    public function eventName(): string
    {
        // TODO: Implement eventName() method.
    }
}
