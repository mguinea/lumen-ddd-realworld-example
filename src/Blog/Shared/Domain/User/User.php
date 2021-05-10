<?php

declare(strict_types=1);

namespace App\Blog\Shared\Domain\User;

use App\Blog\User\Domain\UserBio;
use App\Blog\User\Domain\UserEmail;
use App\Blog\User\Domain\UserId;
use App\Blog\User\Domain\UserImage;
use App\Blog\User\Domain\UserName;
use App\Blog\User\Domain\UserPassword;
use App\Blog\User\Domain\UserToken;

final class User
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
        UserImage $image
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
        ?string $bio = null,
        ?string $image = null
    ): self {
        return new self(
            UserId::fromValue($id),
            UserEmail::fromValue($email),
            UserPassword::fromValue($password),
            UserToken::fromValue($token),
            UserName::fromValue($username),
            UserBio::fromValue($bio),
            UserImage::fromValue($image)
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
