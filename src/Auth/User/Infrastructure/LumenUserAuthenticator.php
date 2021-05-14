<?php

declare(strict_types=1);

namespace App\Auth\User\Infrastructure;

use App\Auth\User\Domain\User as DomainUser;
use App\Auth\User\Domain\UserAuthenticator;
use App\Auth\User\Domain\UserToken;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserPassword;
use App\Auth\User\Infrastructure\Persistence\Eloquent\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Hash;

final class LumenUserAuthenticator implements UserAuthenticator
{
    private AuthManager $authManager;
    private User $model;
    private AuthFactory $authFactory;

    public function __construct(AuthManager $authManager, User $model, AuthFactory $authFactory)
    {
        $this->authManager = $authManager;
        $this->model = $model;
        $this->authFactory = $authFactory;
    }
    public function getCurrentUser(): ?DomainUser
    {
        $user = $this->authFactory->guard()->user();

        if (null === $user) {
            return null;
        }

        return DomainUser::fromPrimitives(
            $user->id,
            $user->email,
            $user->password,
            null
        );
    }

    public function logIn(UserEmail $email, UserPassword $password): ?UserToken
    {
        $user = $this->model
            ->where('email', $email->value())
            ->first();

        if (null === $user || false === Hash::check($password->value(), $user->password)) {
            return null;
        }

        $token = $this->generateToken($email->value(), $password->value());

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

    private function generateToken(string $email, string $password): string
    {
        if (!$token = $this->authManager->attempt(
            [
                'email' => $email,
                'password' => $password
            ]
        )) {
            throw new AuthenticationException();
        }

        return $token;
    }
}
