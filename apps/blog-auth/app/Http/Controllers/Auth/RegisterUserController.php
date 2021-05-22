<?php

declare(strict_types=1);

namespace Apps\BlogAuth\App\Http\Controllers\Auth;

use App\Auth\User\Application\GetUserByIdQuery;
use App\Auth\User\Application\RegisterUserCommand;
use App\Auth\User\Application\UserResponse;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\UuidGenerator;
use Apps\BlogAuth\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class RegisterUserController extends Controller
{
    private CommandBus $commandBus;
    private QueryBus $queryBus;
    private UuidGenerator $generator;

    public function __construct(
        CommandBus $commandBus,
        QueryBus $queryBus,
        UuidGenerator $generator
    ) {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
        $this->generator = $generator;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request, [
            'email' => 'required|email|unique:mysql_auth.users,email',
            'password' => 'required'
        ]);

        $email = $request->get('email');
        $password = $request->get('password');

        $id = $this->generator->generate();

        $this->commandBus->dispatch(
            new RegisterUserCommand(
                $id,
                $email,
                $password
            )
        );

        /** @var UserResponse $userResponse */
        $userResponse = $this->queryBus->ask(
            new GetUserByIdQuery(
                $id
            )
        );

        return new JsonResponse(
            $userResponse->toArray(),
            Response::HTTP_OK
        );
    }
}
