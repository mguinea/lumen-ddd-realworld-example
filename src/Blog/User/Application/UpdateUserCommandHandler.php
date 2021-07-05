<?php

declare(strict_types=1);

namespace App\Blog\User\Application;

use App\Blog\User\Domain\UserBio;
use App\Blog\User\Domain\UserImage;
use App\Blog\User\Domain\UserName;
use App\Blog\User\Domain\UserUpdater;
use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserId;
use App\Shared\Domain\User\UserPassword;

final class UpdateUserCommandHandler implements CommandHandler
{
    public function __construct(private UserUpdater $updater)
    {
    }

    public function __invoke(UpdateUserCommand $command): void
    {
        $id = UserId::fromValue($command->id());
        $name = UserName::fromValue($command->username());
        $email = UserEmail::fromValue($command->email());
        $password = UserPassword::fromValue($command->password());
        $bio = UserBio::fromValue($command->bio());
        $image = UserImage::fromValue($command->image());

        $this->updater->__invoke(
            $id,
            $name,
            $email,
            $password,
            $bio,
            $image
        );
    }
}
