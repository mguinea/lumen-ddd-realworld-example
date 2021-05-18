<?php

declare(strict_types=1);

namespace Apps\BlogApi\App\Http\Controllers\User;


use App\Blog\User\Application\GetUserByIdQuery;
use App\Blog\User\Application\ProfileResponse;
use App\Shared\Domain\Bus\Query\QueryBus;
use Apps\BlogApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class GetCurrentUserController extends Controller
{
    /** @var QueryBus */
    private $queryBus;

    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function __invoke(Request $request, string $id): JsonResponse
    {
        /** @var ProfileResponse $profileResponse */
        $profileResponse = $this->queryBus->ask(
            new GetUserByIdQuery($id)
        );

        return new JsonResponse(
            $profileResponse->toArray(), Response::HTTP_OK
        );
    }
}
