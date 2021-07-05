<?php

declare(strict_types=1);

namespace Apps\BlogApi\App\Http\Controllers\User;

use App\Blog\User\Application\GetCurrentUserQuery;
use App\Blog\User\Application\GetUserByIdQuery;
use App\Blog\User\Application\UpdateUserCommand;
use App\Blog\User\Application\UserResponse;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use Apps\BlogApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class UpdateUserController extends Controller
{
    public function __construct(
        private CommandBus $commandBus,
        private QueryBus $queryBus
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        // TODO validation

        /** @var UserResponse $userResponse */
        $userResponse = $this->queryBus->ask(
            new GetCurrentUserQuery($request->bearerToken())
        );

        $userData = $request->get('user');

        $this->commandBus->dispatch(
            new UpdateUserCommand(
                $userResponse->id(),
                $userData['username'] ?? null,
                $userData['email'] ?? null,
                $userData['password'] ?? null,
                $userData['bio'] ?? null,
                $userData['image'] ?? null
            )
        );

        /** @var UserResponse $userResponse */
        $userResponse = $this->queryBus->ask(
            new GetUserByIdQuery($userResponse->id())
        );

        return new JsonResponse(
            $userResponse->toArray(),
            Response::HTTP_OK
        );
    }
}
