<?php

declare(strict_types=1);

namespace App\Auth\User\Domain;

use App\Shared\Domain\AggregateRoot;

final class User extends AggregateRoot
{
    private UserId $id;
    private UserEmail $email;
    private UserPassword $password;
    private UserToken $token;
    private UserName $username;
    private UserBio $bio;
    private UserImage $image;

    public function __construct(
        UserId $id,
        UserEmail $email,
        UserPassword $password,
        UserToken $token,
        UserName $username,
        UserBio $bio,
        UserImage $image,
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->token = $token;
        $this->username = $username;
        $this->bio = $bio;
        $this->image = $image;
    }

    public static function fromPrimitives(
        string $id,
        string $email,
        string $password,
        ?string $token,
        string $username,
        ?string $bio,
        ?string $image
    ): self {
        return new self(
            UserId::fromValue($id),
            UserEmail::fromValue($email),
            UserPassword::fromValue($password),
            UserToken::fromValue($token),
            UserName::fromValue($username),
            UserBio::fromValue($bio),
            UserImage::fromValue($image),
        );
    }

    public static function register(
        UserName $username,
        UserEmail $email,
        UserPassword $password
    ): self {
        $id = UserId::create();

        return self::fromPrimitives(
            $id->value(),
            $email->value(),
            $password->value(),
            null,
            $username->value(),
            null,
            null
        );
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

    public function username(): UserName
    {
        return $this->username;
    }

    public function bio(): UserBio
    {
        return $this->bio;
    }

    public function image(): UserImage
    {
        return $this->image;
    }
}
