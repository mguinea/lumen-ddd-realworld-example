<?php

declare(strict_types=1);

namespace Apps\BlogApi\App\Http\Controllers\Article;

use App\Blog\Article\Application\ArticleResponse;
use App\Blog\Article\Application\CreateArticleCommand;
use App\Blog\Article\Application\GetArticleByIdQuery;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\UuidGenerator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class CreateArticleController
{
    public function __construct(
        private CommandBus $commandBus,
        private QueryBus $queryBus,
        private UuidGenerator $uuidGenerator
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $id = $this->uuidGenerator->generate();
        // TODO CreateArticleRequest with validations
        $this->commandBus->dispatch(
            new CreateArticleCommand(
                $id,
                $request->input('article.title'),
                $request->input('article.description'),
                $request->input('article.body'),
                $request->input('article.tagList'),
            )
        );

        /** @var ArticleResponse $articleResponse */
        $articleResponse = $this->queryBus->ask(
            new GetArticleByIdQuery($id)
        );

        return new JsonResponse(
            [
                'article' => $articleResponse->toArray()
            ],
            Response::HTTP_OK
        );
    }
}
