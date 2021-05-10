<?php

declare(strict_types=1);

namespace Apps\BlogApi\App\Http\Controllers\Auth;

use App\Blog\User\Application\LogIn;
use Apps\BlogApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class LoginController extends Controller
{
    private LogIn $logIn;

    public function __construct(LogIn $logIn)
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
