<?php

declare(strict_types=1);

namespace Apps\BlogApi\App\Http\Controllers\Article;

use App\Blog\Article\Application\GetArticleBySlugQuery;
use App\Blog\Article\Application\GetArticleBySlugQueryResponse;
use App\Shared\Domain\Bus\Query\QueryBus;
use Apps\BlogApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class GetArticleBySlugController extends Controller
{
    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request, string $slug): JsonResponse
    {
        /** @var GetArticleBySlugQueryResponse $getArticleBySlugQueryResponse */
        $getArticleBySlugQueryResponse = $this->queryBus->ask(
            new GetArticleBySlugQuery($slug)
        );

        return new JsonResponse(
            [
                'article' => $getArticleBySlugQueryResponse->toArray()
            ],
            Response::HTTP_OK
        );
    }
}
