<?php

declare(strict_types=1);

namespace App\Blog\User\Domain;

final class UserWasUpdated extends UserDomainEvent
{
    public function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): UserWasUpdated {
        return new self(
            $aggregateId,
            $body['name'],
            $body['email'],
            $body['password'],
            $body['bio'],
            $body['image'],
            $eventId,
            $occurredOn
        );
    }

    public function eventName(): string
    {
        return 'blog.user.was_updated';
    }
}
