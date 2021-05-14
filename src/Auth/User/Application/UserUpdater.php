<?php

declare(strict_types=1);

namespace App\Auth\User\Application;

use App\Auth\User\Domain\UserBio;
use App\Auth\User\Domain\UserEmail;
use App\Auth\User\Domain\UserImage;
use App\Auth\User\Domain\UserName;
use App\Shared\Domain\User\UserPassword;
use App\Auth\User\Domain\UserUpdater as DomainUserUpdater;

final class UserUpdater
{
    private DomainUserUpdater $updater;

    public function __construct(DomainUserUpdater $updater)
    {
        $this->updater = $updater;
    }

    public function __invoke(
        ?string $username,
        ?string $email,
        ?string $password,
        ?string $bio,
        ?string $image
    ): UserResponse {
        $username = null !== $username ? UserName::fromValue($username) : null;
        $email = null !== $email ? UserEmail::fromValue($email) : null;
        $password = null !== $password ? UserPassword::fromValue($password) : null;
        $bio = null !== $bio ? UserBio::fromValue($bio) : null;
        $image = null !== $image ? UserImage::fromValue($image) : null;

        $user = $this->updater->__invoke(
            $username,
            $email,
            $password,
            $bio,
            $image
        );

        return UserResponse::fromUser($user);
    }
}
