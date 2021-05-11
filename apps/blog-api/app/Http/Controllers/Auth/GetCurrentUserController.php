<?php

declare(strict_types=1);

namespace Apps\BlogApi\App\Http\Controllers\Auth;

use App\Auth\User\Application\GetCurrentUser;
use Apps\BlogApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class GetCurrentUserController extends Controller
{
    private GetCurrentUser $getCurrentUser;

    public function __construct(GetCurrentUser $getCurrentUser)
    {
        $this->getCurrentUser = $getCurrentUser;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $userResponse = $this->getCurrentUser->__invoke();

        return new JsonResponse(
            [
                'user' => $userResponse->toArray()
            ], Response::HTTP_OK
        );
    }
}
