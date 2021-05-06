<?php

declare(strict_types=1);

namespace App\Blog\User\Application;

use App\Blog\Shared\Domain\User\User;

final class UserResponse
{
    private string $email;
    private ?string $token;
    private string $username;
    private ?string $bio;
    private ?string $image;

    public function __construct(
        string $email,
        ?string $token,
        string $username,
        ?string $bio,
        ?string $image
    ) {
        $this->email = $email;
        $this->token = $token;
        $this->username = $username;
        $this->bio = $bio;
        $this->image = $image;
    }

    public static function fromUser(User $user): self
    {
        return new self(
            $user->email()->value(),
            $user->token()->value(),
            $user->username()->value(),
            $user->bio()->value(),
            $user->image()->value()
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

    public function username(): string
    {
        return $this->username;
    }

    public function bio(): ?string
    {
        return $this->bio;
    }

    public function image(): ?string
    {
        return $this->image;
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'token' => $this->token,
            'username' => $this->username,
            'bio' => $this->bio,
            'image' => $this->image
        ];
    }
}
