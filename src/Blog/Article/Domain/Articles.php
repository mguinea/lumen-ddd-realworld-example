<?php

declare(strict_types=1);

namespace App\Blog\Article\Domain;

use App\Shared\Domain\Traversables\Collection;

final class Articles extends Collection
{
    protected function itemsType(): string
    {
        return Article::class;
    }
}
