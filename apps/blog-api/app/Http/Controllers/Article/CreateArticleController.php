<?php

declare(strict_types=1);

namespace Apps\BlogApi\App\Http\Controllers\Article;

use App\Blog\Article\Application\CreateArticleCommand;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\UuidGenerator;
use Apps\BlogApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class CreateArticleController  extends Controller
{
    public function __construct(
        private CommandBus $commandBus,
        private UuidGenerator $uuidGenerator
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $id = $this->uuidGenerator->generate();
        $this->commandBus->dispatch(
            new CreateArticleCommand(
                $id,
                $request->input('title'),
                $request->input('description'),
                $request->input('body'),
                $request->input('tagList'),
            )
        );

        return new JsonResponse(
            [
                'article' => []
            ],
            Response::HTTP_OK
        );
    }
}
