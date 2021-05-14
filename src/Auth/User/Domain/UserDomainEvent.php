<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

use App\Shared\Domain\Bus\Event\DomainEvent;

abstract class UserDomainEvent extends DomainEvent
{
    private string $email;
    private ?string $token;

    public function __construct(
        string $email,
        ?string $token
    ) {
        $this->email = $email;
        $this->token = $token;
    }

    public static function fromUser(User $user): static
    {
        return new static(
            $user->email()->value(),
            $user->token()->value()
        );
    }

    public function email(): string
    {
        return $this->email;
    }

    public function token(): string
    {
        return $this->token;
    }

    public function toPrimitives(): array
    {
        return [
            'email' => $this->email,
            'token' => $this->token
        ];
    }
}
