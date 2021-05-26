<?php

declare(strict_types=1);

namespace Tests\Auth\User\Domain;

use App\Auth\User\Domain\User;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserId;
use App\Shared\Domain\User\UserPassword;
use App\Shared\Domain\User\UserToken;
use Tests\Shared\Domain\Builder;

final class UserBuilder implements Builder
{
    private UserId $id;
    private UserEmail $email;
    private UserPassword $password;
    private UserToken $token;

    public function __construct()
    {
        $this->id = (new UserIdBuilder())->build();
        $this->email = (new UserEmailBuilder())->build();
        $this->password = (new UserPasswordBuilder())->build();
        $this->token = (new UserTokenBuilder())->build();
    }

    public function withId(UserId $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function withEmail(UserEmail $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function withPassword(UserPassword $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function withToken(UserToken $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function build(): User
    {
        return new User(
            $this->id,
            $this->email,
            $this->password,
            $this->token
        );
    }
}
