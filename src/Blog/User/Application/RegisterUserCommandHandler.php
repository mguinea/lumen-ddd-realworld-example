<?php

declare(strict_types=1);

namespace App\Blog\User\Application;

use App\Blog\User\Domain\UserCreator;
use App\Blog\User\Domain\UserName;
use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserId;
use App\Shared\Domain\User\UserPassword;

final class RegisterUserCommandHandler implements CommandHandler
{
    public function __construct(private UserCreator $creator)
    {
    }

    public function __invoke(RegisterUserCommand $command): void
    {
        $this->creator->__invoke(
            UserId::fromValue($command->id()),
            UserName::fromValue($command->username()),
            UserEmail::fromValue($command->email()),
            UserPassword::fromValue($command->password())
        );
    }
}
