<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

use App\Shared\Domain\Bus\Event\DomainEvent;

abstract class UserDomainEvent extends DomainEvent
{
    public function __construct(
        protected string $id,
        protected string $email,
        protected ?string $token = null,
        protected ?string $eventId = null,
        protected ?string $occurredOn = null
    ) {
        parent::__construct(
            $id,
            $eventId,
            $occurredOn
        );
    }

    public static function fromUser(User $user): static
    {
        return new static(
            $user->id()->value(),
            $user->email()->value(),
            $user->token()->value(),
            null,
            null
        );
    }

    public function id(): string
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function token(): ?string
    {
        return $this->token;
    }

    public function fromPrimitives(
        string $aggregateId,
        array $body,
        ?string $eventId = null,
        ?string $occurredOn = null
    ): self {
        return new static(
            $aggregateId,
            $body['email'],
            $body['token'] ?? null,
            $eventId,
            $occurredOn
        );
    }

    public function toPrimitives(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'token' => $this->token,
            'event_id' => $this->eventId,
            'ocurred_on' => $this->occurredOn
        ];
    }
}
