<?php

declare(strict_types=1);

namespace App\Auth\User\Application;

use App\Shared\Domain\Bus\Command\Command;

final class RegisterUserCommand implements Command
{
    public function __construct(
        private string $id,
        private string $email,
        private string $password
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function commandName(): string
    {
        return 'realworld.auth.user.register'; // TODO
    }
}
