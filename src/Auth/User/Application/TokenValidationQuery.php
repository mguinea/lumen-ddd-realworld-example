<?php

declare(strict_types=1);

namespace App\Auth\User\Application;

use App\Shared\Domain\Bus\Query\Query;

final class TokenValidationQuery implements Query
{
    public function __construct(private string $token)
    {
    }

    public function token(): string
    {
        return $this->token;
    }

    public function queryName(): string
    {
        return '';
    }
}
