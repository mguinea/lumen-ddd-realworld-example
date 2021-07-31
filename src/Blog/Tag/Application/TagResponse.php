<?php

declare(strict_types=1);

namespace App\Blog\Tag\Application;

use App\Blog\Tag\Domain\Tag;
use App\Shared\Domain\Bus\Query\Response;

final class TagResponse implements Response
{
    public function __construct(private string $value)
    {
    }

    public static function fromTag(Tag $tag): TagResponse
    {
        return new self($tag->value()->value());
    }

    public function value(): string
    {
        return $this->value;
    }
}
