<?php

declare(strict_types=1);

namespace Apps\BlogApi\App\Http\Controllers\User;

use App\Auth\User\Application\UserUpdater;
use Apps\BlogApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class UpdateUserController extends Controller
{
    private UserUpdater $updater;

    public function __construct(UserUpdater $updater)
    {
        $this->updater = $updater;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $credentials = $request->get('user');

        $userResponse = $this->updater->__invoke(
            $credentials['username'] ?? null,
            $credentials['email'] ?? null,
            $credentials['password'] ?? null,
            $credentials['bio'] ?? null,
            $credentials['image'] ?? null
        );

        return new JsonResponse(
            [
                'user' => $userResponse->toArray()
            ], Response::HTTP_OK
        );
    }
}
