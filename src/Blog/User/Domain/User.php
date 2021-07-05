<?php

declare(strict_types=1);

namespace App\Blog\User\Domain;

use App\Shared\Domain\AggregateRoot;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserId;
use App\Shared\Domain\User\UserPassword;

final class User extends AggregateRoot
{
    private UserId $id;
    private UserName $name;
    private UserEmail $email;
    private UserBio $bio;
    private UserImage $image;

    public function __construct(
        UserId $id,
        UserName $name,
        UserEmail $email,
        UserBio $bio,
        UserImage $image
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->bio = $bio;
        $this->image = $image;
    }

    public static function fromPrimitives(
        string $id,
        string $name,
        string $email,
        ?string $bio = null,
        ?string $image = null
    ): self {
        return new self(
            UserId::fromValue($id),
            UserName::fromValue($name),
            UserEmail::fromValue($email),
            UserBio::fromValue($bio),
            UserImage::fromValue($image)
        );
    }

    public static function create(
        UserId $id,
        UserName $name,
        UserEmail $email,
        UserPassword $password,
        UserBio $bio,
        UserImage $image
    ): self {
        $user = new self(
            $id,
            $name,
            $email,
            $bio,
            $image
        );

        $user->record(UserWasCreated::fromUser($user, $password));

        return $user;
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function name(): UserName
    {
        return $this->name;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function bio(): UserBio
    {
        return $this->bio;
    }

    public function image(): UserImage
    {
        return $this->image;
    }

    public function update(
        UserName $name,
        UserEmail $email,
        UserPassword $password,
        UserBio $bio,
        UserImage $image
    ): void {
        $this->name = null === $name->value() ? $this->name : $name;
        $this->email = null === $email->value() ? $this->email : $email;
        $this->bio = null === $bio->value() ? $this->bio : $bio;
        $this->image = null === $image->value() ? $this->image : $image;

        $this->record(UserWasUpdated::fromUser($this, $password));
    }
}
