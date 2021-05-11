<?php

declare(strict_types=1);

namespace Apps\BlogApi\App\Http\Controllers\Auth;

use App\Auth\User\Application\UserLogIn;
use Apps\BlogApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class UserLogInController extends Controller
{
    private UserLogIn $logIn;

    public function __construct(UserLogIn $logIn)
    {
        $this->logIn = $logIn;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $credentials = $request->get('user');

        $userResponse = $this->logIn->__invoke(
            $credentials['email'] ?? '',
            $credentials['password'] ?? ''
        );

        return new JsonResponse(
            [
                'user' => $userResponse->toArray()
            ], Response::HTTP_OK
        );
    }
}
