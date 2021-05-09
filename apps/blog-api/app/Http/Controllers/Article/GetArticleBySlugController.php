<?php

declare(strict_types=1);

namespace Apps\BlogApi\App\Http\Controllers\User;

use App\Blog\Article\Application\GetArticleBySlug;
use Apps\BlogApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class GetArticleBySlugController extends Controller
{
    private GetArticleBySlug $getArticleBySlug;

    public function __construct(GetArticleBySlug $getArticleBySlug)
    {
        $this->getArticleBySlug = $getArticleBySlug;
    }

    public function __invoke(Request $request, string $slug): JsonResponse
    {
        $articleResponse = $this->getArticleBySlug->__invoke($slug);

        return new JsonResponse(
            [
                'article' => $articleResponse->toArray()
            ], Response::HTTP_OK
        );
    }
}
