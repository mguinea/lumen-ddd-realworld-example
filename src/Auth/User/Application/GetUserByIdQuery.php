<?php

declare(strict_types=1);

namespace App\Auth\User\Application;

use App\Shared\Domain\Bus\Query\Query;

final class GetUserByIdQuery implements Query
{
    public function __construct(private string $id)
    {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function queryName(): string
    {
        return 'realworld.auth.user.get_by_id'; // TODO
    }
}
