<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

use App\Shared\Domain\Bus\Event\DomainEvent;

abstract class UserDomainEvent extends DomainEvent
{
    protected string $id;
    protected string $email;
    protected ?string $token;

    public function __construct(
        string $id,
        string $email,
        ?string $token = null,
        ?string $eventId = null,
        ?string $occurredOn = null
    ) {
        parent::__construct($id, $eventId, $occurredOn);

        $this->id = $id;
        $this->email = $email;
        $this->token = $token;
    }

    public static function fromUser(User $user): static
    {
        return new static(
            $user->id()->value(),
            $user->email()->value(),
            $user->token()->value()
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
        string $eventId,
        string $occurredOn
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
            'token' => $this->token
        ];
    }
}
