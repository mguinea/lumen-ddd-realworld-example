<?php

declare(strict_types=1);

namespace Apps\BlogAuth\App\Http\Controllers\Auth;

use App\Auth\User\Application\GetUserByIdQuery;
use App\Auth\User\Application\RegisterUserCommand;
use App\Auth\User\Application\UserResponse;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\RequestValidator;
use App\Shared\Domain\UuidGenerator;
use Apps\BlogAuth\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class RegisterUserController extends Controller
{
    public function __construct(
        private CommandBus $commandBus,
        private QueryBus $queryBus,
        private UuidGenerator $generator,
        private RequestValidator $validator
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $this->validator->validate(
            $request,
            [
                'email' => 'required|email|unique:mysql_auth.users,email',
                'password' => 'required'
            ]
        );

        $id = $request->get('id', $this->generator->generate());
        $email = $request->get('email');
        $password = $request->get('password');

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
