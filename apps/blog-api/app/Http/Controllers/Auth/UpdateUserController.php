<?php

declare(strict_types=1);

namespace Apps\BlogApi\App\Http\Controllers\Auth;

use App\Auth\User\Application\Updater;
use Apps\BlogApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class UpdateUserController extends Controller
{
    private Updater $updater;

    public function __construct(Updater $updater)
    {
        $this->updater = $updater;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $credentials = $request->get('user');

        $userResponse = $this->updater->__invoke(
            $credentials['username'] ?? '',
            $credentials['email'] ?? '',
            $credentials['password'] ?? '',
            $credentials['image'] ?? '',
            $credentials['bio'] ?? '',
        );

        return new JsonResponse(
            [
                'user' => $userResponse->toArray()
            ], Response::HTTP_OK
        );
    }
}
