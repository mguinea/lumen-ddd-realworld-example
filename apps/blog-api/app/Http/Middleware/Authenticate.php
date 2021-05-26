<?php

namespace Apps\BlogApi\App\Http\Middleware;

use App\Auth\User\Domain\AuthenticationException;
use App\Blog\User\Domain\UserAuthenticator;
use App\Shared\Domain\User\UserToken;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    public function __construct(protected Auth $auth, private UserAuthenticator $authenticator)
    {
    }

    public function handle($request, Closure $next, $guard = null)
    {   // TODO call to every protected request to validate token
        if (!$request->bearerToken()) {
            throw new AuthenticationException();
        }

        if (!$this->authenticator->validate(
            UserToken::fromValue($request->bearerToken())
        )) {
            throw new AuthenticationException();
        }

        return $next($request);
    }
}
