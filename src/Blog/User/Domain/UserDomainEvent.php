<?php

declare(strict_types=1);

namespace App\Blog\User\Domain;

use App\Shared\Domain\Bus\Event\DomainEvent;

abstract class UserDomainEvent extends DomainEvent
{
    private string $id;
    private string $name;
    private string $email;
    private ?string $bio;
    private ?string $image;

    public function __construct(
        string $id,
        string $name,
        string $email,
        ?string $bio = null,
        ?string $image = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->bio = $bio;
        $this->image = $image;
    }

    public static function fromUser(User $user): static
    {
        return new static(
            $user->id()->value(),
            $user->name()->value(),
            $user->email()->value(),
            null === $user->bio() ? null : $user->bio()->value(),
            null === $user->image() ? null : $user->image()->value()
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
            'bio' => $this->bio,
            'image' => $this->image,
        ];
    }
}
