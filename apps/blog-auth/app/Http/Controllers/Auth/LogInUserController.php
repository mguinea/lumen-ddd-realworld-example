<?php

declare(strict_types=1);

namespace Apps\BlogAuth\App\Http\Controllers\Auth;

use App\Auth\User\Application\LogInUserQuery;
use App\Shared\Domain\Bus\Query\QueryBus;
use Apps\BlogAuth\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class LogInUserController extends Controller
{
    private QueryBus $queryBus;

    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function __invoke(Request $request): JsonResponse
    {
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
