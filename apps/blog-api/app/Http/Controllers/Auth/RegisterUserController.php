<?php

declare(strict_types=1);

namespace Apps\BlogApi\App\Http\Controllers\Auth;

use App\Auth\User\Application\Register;
use Apps\BlogApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class RegisterUserController extends Controller
{
    private Register $register;

    public function __construct(Register $register)
    {
        $this->register = $register;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $credentials = $request->get('user');

        $userResponse = $this->register->__invoke(
            $credentials['username'] ?? '',
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
