<?php

declare(strict_types=1);

namespace App\Blog\User\Application;

abstract class UserResponse
{
    private string $username;
    private string $bio;
    private string $image;
    private bool $following;

    public function __construct(
        string $username,
        string $bio,
        string $image,
        bool $following
    ) {
        $this->username = $username;
        $this->bio = $bio;
        $this->image = $image;
        $this->following = $following;
    }

    public function username(): string
    {
        return $this->username;
    }

    public function bio(): string
    {
        return $this->bio;
    }

    public function image(): string
    {
        return $this->image;
    }

    public function following(): bool
    {
        return $this->following;
    }

    abstract public function toArray(): array;
}
