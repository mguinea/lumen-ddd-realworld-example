<?php

declare(strict_types=1);

namespace App\Auth\User\Application;

use App\Shared\Domain\Bus\Query\Response;

final class TokenResponse implements Response
{
    public function __construct(private string $id, private string $expires)
    {
    }

    public static function fromArray(array $token): self
    {
        return new self($token['id'], $token['expires']);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function expires(): string
    {
        return $this->expires;
    }

    public function toArray(): array
    {
        return [
            'token' => [
                'id' => $this->id,
                'expires' => $this->expires
            ]
        ];
    }
}
