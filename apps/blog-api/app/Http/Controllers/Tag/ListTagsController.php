<?php

declare(strict_types=1);

namespace Apps\BlogApi\App\Http\Controllers\Tag;

use App\Blog\Tag\Application\ListingTagsQuery;
use App\Blog\Tag\Application\TagsResponse;
use App\Shared\Domain\Bus\Query\QueryBus;
use Apps\BlogApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class ListTagsController extends Controller
{
    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        /** @var TagsResponse $tagsResponse */
        $tagsResponse = $this->queryBus->ask(
            new ListingTagsQuery()
        );

        return new JsonResponse(
            [
                'tags' => array_map(function ($tag) {
                    return $tag->value();
                }, $tagsResponse->tags())
            ],
            Response::HTTP_OK
        );
    }
}
