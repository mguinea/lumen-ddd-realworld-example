<?php

declare(strict_types=1);

namespace Apps\BlogApi\App\Http\Controllers\User;

use App\Blog\User\Application\LogInUserQuery;
use App\Blog\User\Application\RegisterUserCommand;
use App\Blog\User\Application\UserResponse;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\UuidGenerator;
use Apps\BlogApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class RegisterUserController extends Controller
{
    public function __construct(
        private CommandBus $commandBus,
        private QueryBus $queryBus,
        private UuidGenerator $generator
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request, [
            'user.email' => 'required|email',
            'user.username' => 'required',
            'user.password' => 'required'
        ]);

        $userData = $request->get('user');

        $id = $this->generator->generate();

        $this->commandBus->dispatch(
            new RegisterUserCommand(
                $id,
                $userData['username'],
                $userData['email'],
                $userData['password']
            )
        );

        /** @var UserResponse $userResponse */
        $userResponse = $this->queryBus->ask(
            new LogInUserQuery(
                $userData['email'],
                $userData['password']
            )
        );

        return new JsonResponse(
            $userResponse->toArray(),
            Response::HTTP_OK
        );
    }
}
