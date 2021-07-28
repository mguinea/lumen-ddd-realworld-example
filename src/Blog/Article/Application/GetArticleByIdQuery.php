<?php

declare(strict_types=1);

namespace App\Blog\Article\Application;

use App\Shared\Domain\Bus\Query\Query;

final class GetArticleByIdQuery implements Query
{
    public function __construct(private string $id)
    {
    }

    public function id(): string
    {
        return $this->id;
    }
}
