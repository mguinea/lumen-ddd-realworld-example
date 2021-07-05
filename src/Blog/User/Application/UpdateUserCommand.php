<?php

declare(strict_types=1);

namespace App\Blog\User\Application;

use App\Shared\Domain\Bus\Command\Command;

final class UpdateUserCommand implements Command
{
    public function __construct(
        private string $id,
        private ?string $username = null,
        private ?string $email = null,
        private ?string $password = null,
        private ?string $bio = null,
        private ?string $image = null
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function username(): ?string
    {
        return $this->username;
    }

    public function email(): ?string
    {
        return $this->email;
    }

    public function password(): ?string
    {
        return $this->password;
    }

    public function bio(): ?string
    {
        return $this->bio;
    }

    public function image(): ?string
    {
        return $this->image;
    }

    public function commandName(): string
    {
        // TODO: Implement commandName() method.
    }
}
