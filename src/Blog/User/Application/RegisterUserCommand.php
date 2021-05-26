<?php

declare(strict_types=1);

namespace App\Blog\User\Application;

use App\Shared\Domain\Bus\Command\Command;

final class RegisterUserCommand implements Command
{
    public function __construct(
        private string $id,
        private string $username,
        private string $email,
        private string $password
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function username(): string
    {
        return $this->username;
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
        return ''; // TODO
    }
}
