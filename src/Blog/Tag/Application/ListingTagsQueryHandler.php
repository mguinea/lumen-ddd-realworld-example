<?php

declare(strict_types=1);

namespace App\Blog\Tag\Application;

use App\Shared\Domain\Bus\Query\QueryHandler;

final class ListingTagsQueryHandler implements QueryHandler
{
    public function __construct(private ListingTags $listingTags)
    {
    }

    public function __invoke(ListingTagsQuery $query): TagsResponse
    {
        $tags = $this->listingTags->__invoke();

        return TagsResponse::fromTags($tags);
    }
}
