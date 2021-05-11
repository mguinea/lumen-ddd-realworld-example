<?php

declare(strict_types=1);

namespace Tests\Auth\User\Domain;

use App\Auth\User\Domain\UserImage;
use Faker\Factory;
use Tests\Shared\Domain\Builder;

final class UserImageBuilder implements Builder
{
    private ?string $value;

    public function __construct()
    {
        $this->value = Factory::create()->imageUrl();
    }

    public function withValue(?string $value = null): self
    {
        $this->value = $value;

        return $this;
    }

    public function build(): UserImage
    {
        return new UserImage($this->value);
    }
}