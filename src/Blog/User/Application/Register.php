<?php

declare(strict_types=1);

namespace App\Blog\User\Application;

use App\Blog\User\Domain\UserBio;
use App\Blog\User\Domain\UserEmail;
use App\Blog\User\Domain\UserImage;
use App\Blog\User\Domain\UserName;
use App\Blog\User\Domain\UserPassword;
use App\Blog\User\Domain\UserRegistrator;

final class Register
{
    private UserRegistrator $registrator;

    public function __construct(UserRegistrator $registrator)
    {
        $this->registrator = $registrator;
    }

    public function __invoke(string $username, string $email, string $password, ?string $bio, ?string $image): UserResponse
    {
        $username = UserName::fromValue($username);
        $email = UserEmail::fromValue($email);
        $password = UserPassword::fromValue($password);
        $bio = UserBio::fromValue($bio);
        $image = UserImage::fromValue($image);

        $user = $this->registrator->__invoke($username, $email, $password, $bio, $image);

        return UserResponse::fromUser($user);
    }
}
