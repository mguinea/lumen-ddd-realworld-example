<?php

declare(strict_types=1);

namespace App\Auth\User\Infrastructure\Persistence\Eloquent;

use App\Auth\User\Domain\User as DomainUser;
use App\Auth\User\Domain\UserEmail;
use App\Auth\User\Domain\UserPassword;
use App\Auth\User\Domain\UserRepository;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Hash;

final class EloquentUserRepository implements UserRepository
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

    public function findByEmail(UserEmail $email): ?DomainUser
    {
        $user = $this->model->where('email', $email->value())->first();

        if (null === $user) {
            return null;
        }

        return DomainUser::fromPrimitives(
            $user->id,
            $user->email,
            $user->password,
            null,
            $user->username,
            $user->bio,
            $user->image
        );
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
            null,
            $user->username,
            $user->bio,
            $user->image
        );
    }

    public function logIn(UserEmail $email, UserPassword $password): ?DomainUser
    {
        $user = $this->model
            ->where('email', $email->value())
            ->first();

        if (null === $user || false === Hash::check($password->value(), $user->password)) {
            return null;
        }

        $token = $this->generateToken($email->value(), $password->value());

        return DomainUser::fromPrimitives(
            $user->id,
            $user->email,
            $user->password,
            $token,
            $user->username,
            $user->bio,
            $user->image
        );
    }

    public function register(DomainUser $domainUser): DomainUser
    {
        $hashedPassword = (new BcryptHasher)->make($domainUser->password()->value());

        $user = new User;
        $user->username = $domainUser->username()->value();
        $user->email = $domainUser->email()->value();
        $user->password = $hashedPassword;
        $user->bio = $domainUser->bio()->value();
        $user->image = $domainUser->image()->value();
        $user->save();

        $token = $this->generateToken($domainUser->email()->value(), $domainUser->password()->value());

        return DomainUser::fromPrimitives(
            $user->id,
            $user->email,
            $user->password,
            $token,
            $user->username,
            $user->bio,
            $user->image
        );
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
