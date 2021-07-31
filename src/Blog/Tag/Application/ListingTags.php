<?php

declare(strict_types=1);

namespace App\Blog\Tag\Application;

use App\Blog\Shared\Domain\Tag\Tags;
use App\Blog\Tag\Domain\TagRepository;

final class ListingTags
{
    public function __construct(private TagRepository $repository)
    {
    }

    public function __invoke(): Tags
    {
        return $this->repository->all();
    }
}
