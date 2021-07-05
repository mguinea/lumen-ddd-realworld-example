<?php

declare(strict_types=1);

namespace Apps\BlogApi\App\Http\Controllers\User;

use App\Blog\User\Application\GetCurrentUserQuery;
use App\Blog\User\Application\UserResponse;
use App\Shared\Domain\Bus\Query\QueryBus;
use Apps\BlogApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class GetCurrentUserController extends Controller
{
    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        /** @var UserResponse $userResponse */
        $userResponse = $this->queryBus->ask(
            new GetCurrentUserQuery($request->bearerToken())
        );

        return new JsonResponse(
            $userResponse->toArray(),
            Response::HTTP_OK
        );
    }
}
