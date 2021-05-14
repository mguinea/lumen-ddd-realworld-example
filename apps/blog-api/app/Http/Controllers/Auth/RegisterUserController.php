<?php

declare(strict_types=1);

namespace Apps\BlogApi\App\Http\Controllers\Auth;

use App\Auth\User\Domain\UserAuthenticator;
use App\Blog\User\Application\UserCreator;
use App\Shared\Application\UserResponse;
use App\Shared\Domain\User\UserId;
use Apps\BlogApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class RegisterUserController extends Controller
{
    private UserAuthenticator $authenticator;
    private UserCreator $userCreator;

    public function __construct(
        UserAuthenticator $authenticator,
        UserCreator $userCreator
    ) {
        $this->authenticator = $authenticator;
        $this->userCreator = $userCreator;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $userData = $request->get('user');

        $id = UserId::create();

        $this->userCreator->__invoke(
            $id->value(),
            $userData['username'] ?? '',
            $userData['email'] ?? '',
            $userData['password'] ?? ''
        );

        dd('stop');
        $token = $this->authenticator->logIn(
            $userData['email'],
            $userData['password']
        );

        $userResponse = UserResponse::fromPrimitives(
            $userData['email'],
            $token,
            $userData['username'],
            null,
            null
        );

        return new JsonResponse(
            [
                $userResponse->toArray()
            ], Response::HTTP_OK
        );
    }
}
