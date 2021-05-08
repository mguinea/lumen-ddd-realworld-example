<?php

declare(strict_types=1);

namespace App\Blog\User\Infrastructure\Persistence\Eloquent;

use App\Blog\Shared\Domain\User\User as DomainUser;
use App\Blog\User\Domain\UserBio;
use App\Blog\User\Domain\UserEmail;
use App\Blog\User\Domain\UserImage;
use App\Blog\User\Domain\UserName;
use App\Blog\User\Domain\UserPassword;
use App\Blog\User\Domain\UserRepository;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\AuthManager;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Contracts\Auth\Factory as AuthFactory;

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

        return $user;
    }

    public function getCurrentUser(): ?DomainUser
    {
        $user = $this->authFactory->guard()->user();

        return DomainUser::fromPrimitives(
            $user->id,
            $user->email,
            '',
            $user->username,
            $user->bio,
            $user->image
        );
    }

    public function logIn(UserEmail $email, UserPassword $password): DomainUser
    {
        $token = $this->generateToken($email->value(), $password->value());

        $user = $this->model->where('email', $email->value())->first();

        return DomainUser::fromPrimitives(
            $user->id,
            $user->email,
            $token,
            $user->username,
            $user->bio,
            $user->image
        );
    }

    public function register(UserName $username, UserEmail $email, UserPassword $password, UserBio $bio, UserImage $image): DomainUser
    {
        $hashedPassword = (new BcryptHasher)->make($password->value()); // TODO move to domain
        // TODO transaction
        $user = new User;
        $user->username = $username->value();
        $user->email = $email->value();
        $user->password = $hashedPassword;
        $user->bio = $bio->value();
        $user->image = $image->value();
        $user->save();

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
