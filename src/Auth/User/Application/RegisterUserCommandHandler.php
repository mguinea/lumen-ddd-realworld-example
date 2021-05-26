<?php

declare(strict_types=1);

namespace App\Auth\User\Application;

use App\Auth\User\Domain\User;
use App\Auth\User\Domain\UserRepository;
use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Shared\Domain\Bus\Event\EventBus;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserId;
use App\Shared\Domain\User\UserPassword;

final class RegisterUserCommandHandler implements CommandHandler
{
    public function __construct(
        private UserRepository $repository,
        private EventBus $eventBus
    ) {
    }

    public function __invoke(RegisterUserCommand $command): void
    {
        $id = UserId::fromValue($command->id());
        $email = UserEmail::fromValue($command->email());
        $password = UserPassword::fromValue($command->password());

        $user = User::register($id, $email, $password);

        $this->repository->save($user);
        $this->eventBus->publish(...$user->pullDomainEvents());
    }
}
