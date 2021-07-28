<?php

declare(strict_types=1);

namespace Apps\AuthApi\App\Http\Controllers\Auth;

use App\Auth\User\Application\TokenResponse;
use App\Auth\User\Application\TokenValidationQuery;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\RequestValidator;
use Apps\AuthApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class ValidateTokenController extends Controller
{
    public function __construct(private QueryBus $queryBus, private RequestValidator $validator)
    {
    }

    public function __invoke(Request $request)
    {
        $this->validator->validate(
            $request,
            [
                'token' => 'string|required'
            ]
        );

        $token = $request->get('token');

        /** @var TokenResponse $tokenResponse */
        $tokenResponse = $this->queryBus->ask(
            new TokenValidationQuery($token)
        );

        return new JsonResponse(
            $tokenResponse->toArray(),
            Response::HTTP_OK
        );
    }
}
