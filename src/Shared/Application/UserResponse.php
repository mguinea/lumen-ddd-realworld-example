<?php

declare(strict_types=1);

namespace App\Shared\Application;

use App\Shared\Domain\Bus\Query\Response;

final class UserResponse implements Response
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

    public static function fromPrimitives(
        string $email,
        ?string $token,
        string $username,
        ?string $bio,
        ?string $image
    ): self {
        return new self(
            $email,
            $token,
            $username,
            $bio,
            $image
        );
    }

    public function email(): string
    {
        return $this->email;
    }

    public function token(): ?string
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
            'user' => [
                'email' => $this->email,
                'token' => $this->token,
                'username' => $this->username,
                'bio' => $this->bio,
                'image' => $this->image
            ]
        ];
    }
}
