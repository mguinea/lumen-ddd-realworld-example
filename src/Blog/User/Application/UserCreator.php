<?php

declare(strict_types=1);

namespace App\Blog\User\Application;

use App\Blog\User\Domain\AuthUserRegistrator;
use App\Blog\User\Domain\UserName;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserId;
use App\Shared\Domain\User\UserPassword;
use App\Blog\User\Domain\UserCreator as DomainUserCreator;

final class UserCreator
{
    private DomainUserCreator $creator;
    private AuthUserRegistrator $registrator;

    public function __construct(DomainUserCreator $creator) //, AuthUserRegistrator $registrator)
    {
        $this->creator = $creator;
        //$this->registrator = $registrator;
    }

    public function __invoke(
        string $id,
        string $username,
        string $email,
        string $password
    ) {
        $id = UserId::fromValue($id);
        $username = UserName::fromValue($username);
        $email = UserEmail::fromValue($email);
        $password = UserPassword::fromValue($password);

        $this->creator->__invoke(
            $id,
            $username,
            $email
        );

        // $this->registrator->register($email, $password); // TODO maybe move to a sync event bus
    }
}
