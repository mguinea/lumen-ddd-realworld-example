<?php

declare(strict_types=1);

namespace App\Blog\Article\Application;

use App\Shared\Domain\Bus\Query\Query;

final class GetArticleBySlugQuery implements Query
{
    public function __construct(private string $slug)
    {
    }

    public function slug(): string
    {
        return $this->slug;
    }
}
