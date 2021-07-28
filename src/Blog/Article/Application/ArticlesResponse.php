<?php

declare(strict_types=1);

namespace App\Blog\Article\Application;

use App\Shared\Domain\Arrayable;
use App\Shared\Domain\Bus\Query\Response;

final class ArticlesResponse implements Arrayable, Response
{
    public function __construct(array $articles = [])
    {
    }

    public function toArray(): array
    {
        return [1];
    }
}
