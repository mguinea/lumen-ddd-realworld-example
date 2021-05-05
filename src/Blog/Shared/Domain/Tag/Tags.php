<?php

declare(strict_types=1);

namespace App\Blog\Shared\Domain\Tag;

use App\Blog\Tag\Domain\Tag;
use App\Shared\Domain\Traversables\Collection;

final class Tags extends Collection
{
    protected function itemsType(): string
    {
        return Tag::class;
    }
}
