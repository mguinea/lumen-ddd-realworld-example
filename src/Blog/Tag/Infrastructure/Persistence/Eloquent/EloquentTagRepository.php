<?php

declare(strict_types=1);

namespace App\Blog\Tag\Infrastructure\Persistence\Eloquent;

use App\Blog\Shared\Domain\Tag\Tags;
use App\Blog\Tag\Domain\TagRepository;

final class EloquentTagRepository implements TagRepository
{
    public function __construct(private Tag $eloquentTag)
    {
    }

    public function all(): Tags
    {
        $eloquentTags = $this->eloquentTag->all();

        $tags = $eloquentTags->map(function(Tag $eloquentTag) {
            return \App\Blog\Tag\Domain\Tag::fromPrimitives(
                $eloquentTag->id,
                $eloquentTag->value
            );
        });

        return Tags::create($tags->toArray());
    }
}
