<?php

declare(strict_types=1);

namespace Apps\BlogAuth\App\Http\Controllers\Auth;

use App\Blog\User\Application\GetUserByIdQuery;
use App\Blog\User\Application\RegisterUserCommand;
use App\Shared\Application\UserResponse;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\User\UserId;
use Apps\BlogAuth\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class RegisterUserController extends Controller
{
    private CommandBus $commandBus;
    private QueryBus $queryBus;

    public function __construct(
        CommandBus $commandBus,
        QueryBus $queryBus
    ) {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    public function __invoke(Request $request): JsonResponse
    {
        dd('stop');
        // TODO $this->validate($request, [
        // TODO     'email' => 'required|email|unique:mysql_blog.users,email',
        // TODO     'password' => 'required'
        // TODO ]);
        /*
        $userData = $request->get('user');

        $id = UserId::create();

        $this->commandBus->dispatch(
            new RegisterUserCommand(
                $id->value(),
                $userData['username'],
                $userData['email'],
                $userData['password']
            )
        );

        /** @var UserResponse $userResponse *
        $userResponse = $this->queryBus->ask(
            new GetUserByIdQuery(
                $id->value()
            )
        );

        return new JsonResponse(
            $userResponse->toArray(),
            Response::HTTP_OK
        );*/
    }
}
