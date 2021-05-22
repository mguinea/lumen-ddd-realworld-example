<?php

declare(strict_types=1);

namespace App\Blog\User\Domain;

use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\User\UserPassword;

abstract class UserDomainEvent extends DomainEvent
{
    private string $id;
    private string $name;
    private string $email;
    private string $password;
    private ?string $bio;
    private ?string $image;

    public function __construct(
        string $id,
        string $name,
        string $email,
        string $password,
        ?string $bio = null,
        ?string $image = null,
        ?string $eventId = null,
        ?string $occurredOn = null
    ) {
        parent::__construct($id, $eventId, $occurredOn);

        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->bio = $bio;
        $this->image = $image;
    }

    public static function fromUser(User $user, UserPassword $password): static
    {
        return new static(
            $user->id()->value(),
            $user->name()->value(),
            $user->email()->value(),
            $password->value(),
            $user->bio()->value(),
            $user->image()->value()
        );
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function bio(): ?string
    {
        return $this->bio;
    }

    public function image(): ?string
    {
        return $this->image;
    }

    public function toPrimitives(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'bio' => $this->bio,
            'image' => $this->image,
        ];
    }
}
