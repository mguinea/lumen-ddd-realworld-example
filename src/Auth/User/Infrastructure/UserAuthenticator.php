<?php

declare(strict_types=1);

namespace App\Auth\User\Infrastructure;

use App\Auth\User\Domain\AuthenticationException;
use App\Auth\User\Domain\TokenManager;
use App\Auth\User\Domain\User as DomainUser;
use App\Auth\User\Domain\UserAuthenticator as UserAuthenticatorInterface;
use App\Shared\Domain\User\UserToken;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserPassword;
use App\Auth\User\Infrastructure\Persistence\Eloquent\User;
use Carbon\Carbon;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Hash;

final class UserAuthenticator implements UserAuthenticatorInterface
{
    public function __construct(
        private TokenManager $tokenManager,
        private User $model
    ) {
    }

    public function logIn(UserEmail $email, UserPassword $password): ?UserToken
    {
        $user = $this->model
            ->where('email', $email->value())
            ->first();

        if (null === $user || false === Hash::check($password->value(), $user->password)) {
            throw new AuthenticationException();
        }

        $token = $this->tokenManager->encode(
            [
                'id' => $user->id,
                'expires' => Carbon::now()->addMinutes(30) // TODO move to config file
            ]
        );

        return UserToken::fromValue($token);
    }

    public function register(DomainUser $domainUser): void
    {
        $hashedPassword = (new BcryptHasher)->make($domainUser->password()->value());

        $user = new User;
        $user->email = $domainUser->email()->value();
        $user->password = $hashedPassword;
        $user->save();
    }
}
