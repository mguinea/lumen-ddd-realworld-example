<?php

declare(strict_types=1);

namespace Apps\AuthApi\App\Http\Controllers\Auth;

use App\Auth\User\Application\LogInUserQuery;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\RequestValidator;
use Apps\AuthApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class LogInUserController extends Controller
{
    public function __construct(
        private QueryBus $queryBus,
        private RequestValidator $validator
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $this->validator->validate(
            $request,
            [
                'email' => 'required|email|exists:mysql_auth.users,email',
                'password' => 'required'
            ]
        );

        $email = $request->get('email');
        $password = $request->get('password');

        $userResponse = $this->queryBus->ask(
            new LogInUserQuery(
                $email,
                $password
            )
        );

        return new JsonResponse(
            $userResponse->toArray(),
            Response::HTTP_OK
        );
    }
}
