<?php

declare(strict_types=1);

namespace Apps\BlogApi\App\Http\Controllers\User;

use App\Blog\User\Application\LogInUserQuery;
use App\Blog\User\Application\UserResponse;
use App\Shared\Domain\Bus\Query\QueryBus;
use Apps\BlogApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class LogInUserController extends Controller
{
    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $user = $request->get('user');

        /** @var UserResponse $userResponse */
        $userResponse = $this->queryBus->ask(
            new LogInUserQuery(
                $user['email'],
                $user['password']
            )
        );

        return new JsonResponse(
            $userResponse->toArray(),
            Response::HTTP_OK
        );
    }
}
