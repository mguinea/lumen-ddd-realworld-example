<?php

declare(strict_types=1);

namespace App\Blog\User\Application;

use App\Shared\Domain\Bus\Query\Response;

abstract class AbstractUserResponse implements Response
{
    public function __construct(
        protected string $username,
        protected string $bio,
        protected string $image,
        protected bool $following
    ) {
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
