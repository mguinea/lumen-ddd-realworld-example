<?php

declare(strict_types=1);

namespace App\Auth\User\Infrastructure\Persistence\Eloquent;

use App\Auth\User\Domain\User as DomainUser;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserId;
use App\Auth\User\Domain\UserRepository;
use Illuminate\Hashing\BcryptHasher;

final class EloquentUserRepository implements UserRepository
{
    private User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
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
            null
        );
    }

    public function findById(UserId $id): ?DomainUser
    {
        $user = $this->model->where('id', $id->value())->first();

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

    public function save(DomainUser $domainUser): void
    {
        $hashedPassword = (new BcryptHasher)->make($domainUser->password()->value());

        $user = $this->model->find($domainUser->id()->value());

        if (null === $user) {
            $user = new User();
            $user->id = $domainUser->id()->value();
        }

        $user->email = $domainUser->email()->value();
        $user->password = $hashedPassword;
        $user->save();
    }
}
