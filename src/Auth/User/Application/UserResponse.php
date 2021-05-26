<?php

declare(strict_types=1);

namespace App\Auth\User\Application;

use App\Auth\User\Domain\User;
use App\Shared\Domain\Bus\Query\Response;

final class UserResponse implements Response
{
    public function __construct(
        private string $id,
        private string $email,
        private ?string $token
    ) {
    }

    public static function fromUser(User $user): self
    {
        return new self(
            $user->id()->value(),
            $user->email()->value(),
            $user->token()->value()
        );
    }

    public static function fromPrimitives(
        string $id,
        string $email,
        string $token
    ): self
    {
        return new self(
            $id,
            $email,
            $token
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

    public function token(): string
    {
        return $this->token;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'token' => $this->token
        ];
    }
}
