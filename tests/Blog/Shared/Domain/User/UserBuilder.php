<?php

declare(strict_types=1);

namespace Tests\Blog\Shared\Domain\User;

use App\Blog\Shared\Domain\User\User;
use App\Blog\User\Domain\UserBio;
use App\Blog\User\Domain\UserEmail;
use App\Blog\User\Domain\UserId;
use App\Blog\User\Domain\UserImage;
use App\Blog\User\Domain\UserName;
use App\Blog\User\Domain\UserPassword;
use App\Blog\User\Domain\UserToken;
use Tests\Blog\User\Domain\UserBioBuilder;
use Tests\Blog\User\Domain\UserEmailBuilder;
use Tests\Blog\User\Domain\UserIdBuilder;
use Tests\Blog\User\Domain\UserImageBuilder;
use Tests\Blog\User\Domain\UserNameBuilder;
use Tests\Blog\User\Domain\UserPasswordBuilder;
use Tests\Blog\User\Domain\UserTokenBuilder;
use Tests\Shared\Domain\Builder;

final class UserBuilder implements Builder
{
    private UserId $id;
    private UserEmail $email;
    private UserPassword $password;
    private UserToken $token;
    private UserName $username;
    private UserBio $bio;
    private UserImage $image;

    public function __construct()
    {
        $this->id = (new UserIdBuilder())->build();
        $this->email = (new UserEmailBuilder())->build();
        $this->password = (new UserPasswordBuilder())->build();
        $this->token = (new UserTokenBuilder())->build();
        $this->username = (new UserNameBuilder())->build();
        $this->bio = (new UserBioBuilder())->build();
        $this->image = (new UserImageBuilder())->build();
    }

    public function withId(UserId $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function withEmail(UserEmail $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function withPassword(UserPassword $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function withToken(UserToken $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function withUsername(UserName $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function withBio(UserBio $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    public function withImage(UserImage $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function build(): User
    {
        return new User(
            $this->id,
            $this->email,
            $this->password,
            $this->token,
            $this->username,
            $this->bio,
            $this->image
        );
    }
}
