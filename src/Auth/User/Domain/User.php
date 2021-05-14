<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

use App\Shared\Domain\AggregateRoot;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserId;
use App\Shared\Domain\User\UserPassword;

final class User extends AggregateRoot
{
    private UserId $id;
    private UserEmail $email;
    private UserPassword $password;
    private UserToken $token;

    public function __construct(
        UserId $id,
        UserEmail $email,
        UserPassword $password,
        UserToken $token
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->token = $token;
    }

    public static function fromPrimitives(
        string $id,
        string $email,
        string $password,
        ?string $token
    ): self {
        return new self(
            UserId::fromValue($id),
            UserEmail::fromValue($email),
            UserPassword::fromValue($password),
            UserToken::fromValue($token)
        );
    }

    public static function register(
        UserEmail $email,
        UserPassword $password
    ): self {
        $id = UserId::create();

        $user = self::fromPrimitives(
            $id->value(),
            $email->value(),
            $password->value(),
            null
        );

        $user->record(UserWasRegistered::fromUser($user));

        return $user;
    }

    public function update(
        ?UserEmail $email,
        ?UserPassword $password
    ): void {
        $this->email = null !== $email ? $email : $this->email;
        $this->password = null !== $password ? $password : $this->password;

        $this->record(UserWasUpdated::fromUser($this));
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function password(): UserPassword
    {
        return $this->password;
    }

    public function token(): UserToken
    {
        return $this->token;
    }
}
