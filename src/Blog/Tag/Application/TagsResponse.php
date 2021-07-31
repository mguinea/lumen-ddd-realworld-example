<?php

declare(strict_types=1);

namespace App\Blog\Tag\Application;

use App\Blog\Shared\Domain\Tag\Tags;
use App\Blog\Tag\Domain\Tag;
use App\Shared\Domain\Bus\Query\Response;

final class TagsResponse implements Response
{
    private array $tags;

    public function __construct(array $tags)
    {
        $this->tags = $tags;
    }

    public static function fromTags(Tags $tags): self
    {
        $tagsResponse = array_map(function(Tag $tag) {
            return TagResponse::fromTag($tag);
        }, $tags->items());

        return new self($tagsResponse);
    }

    public function tags(): array
    {
        return $this->tags;
    }
}
