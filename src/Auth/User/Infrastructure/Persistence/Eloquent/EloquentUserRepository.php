<?php

declare(strict_types=1);

namespace App\Auth\User\Infrastructure\Persistence\Eloquent;

use App\Auth\User\Domain\User as DomainUser;
use App\Auth\User\Domain\UserEmail;
use App\Shared\Domain\User\UserPassword;
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

    public function save(DomainUser $domainUser): void
    {
        $hashedPassword = (new BcryptHasher)->make($domainUser->password()->value());

        $user = $this->model->find($domainUser->id()->value());
        $user->username = $domainUser->username()->value();
        $user->email = $domainUser->email()->value();
        $user->password = $hashedPassword;
        $user->bio = $domainUser->bio()->value();
        $user->image = $domainUser->image()->value();
        $user->save();
    }
}
