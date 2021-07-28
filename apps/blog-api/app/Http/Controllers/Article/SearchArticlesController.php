<?php

declare(strict_types=1);

namespace Apps\BlogApi\App\Http\Controllers\Article;

use App\Blog\Article\Application\ArticlesResponse;
use App\Blog\Article\Application\SearchArticlesQuery;
use App\Shared\Domain\Bus\Query\QueryBus;
use Apps\BlogApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class SearchArticlesController extends Controller
{
    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $limit = $request->input('limit');
        $offset = $request->input('offset');

        /** @var ArticlesResponse $articlesResponse */
        $articlesResponse = $this->queryBus->ask(
            new SearchArticlesQuery(
                $this->filters($request, [
                    ['field' => 'tag'],
                    ['field' => 'author'],
                    ['field' => 'favorited']
                ]), // TODO filters use object with toArray?
                $request->input('orderBy'),
                $request->input('order'),
                null === $limit ? null : (int)$limit,
                null === $offset ? null : (int)$offset
            )
        );

        return new JsonResponse(
            [
                'articles' => $articlesResponse->toArray()
            ],
            Response::HTTP_OK
        );
    }
}
