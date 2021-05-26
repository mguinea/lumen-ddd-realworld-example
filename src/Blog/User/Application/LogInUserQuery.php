<?php

declare(strict_types=1);

namespace App\Blog\User\Application;

use App\Shared\Domain\Bus\Query\Query;

final class LogInUserQuery implements Query
{
    public function __construct(
        private string $email,
        private string $password
    ) {
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function queryName(): string
    {
        return ''; // TODO
    }
}
