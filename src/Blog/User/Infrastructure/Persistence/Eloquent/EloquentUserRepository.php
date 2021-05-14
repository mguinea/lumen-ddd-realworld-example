<?php

declare(strict_types=1);

namespace App\Blog\User\Infrastructure\Persistence\Eloquent;

use App\Blog\User\Domain\User as DomainUser;
use App\Blog\User\Domain\UserRepository;
use App\Shared\Domain\User\UserEmail;
use Illuminate\Database\DatabaseManager;

final class EloquentUserRepository implements UserRepository
{
    private DatabaseManager $db;
    private User $model;

    public function __construct(DatabaseManager $db, User $model)
    {
        $this->db = $db;
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
            $user->name,
            $user->email,
            $user->bio,
            $user->image
        );
    }

    public function save(DomainUser $domainUser): void
    {
        $user = $this->model->find(
            $domainUser->id()->value()
        );

        if (null === $user) {
            $user = new User();
        }

        $this->db->transaction(function() use ($user, $domainUser) {
            $user->id = $domainUser->id()->value();
            $user->name = $domainUser->name()->value();
            $user->email = $domainUser->email()->value();
            $user->bio = $domainUser->bio()->value();
            $user->image = $domainUser->image()->value();

            $user->save();
        });
    }
}
