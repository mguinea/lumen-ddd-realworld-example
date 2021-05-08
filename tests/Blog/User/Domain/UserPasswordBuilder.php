<?php

declare(strict_types=1);

namespace Tests\Blog\User\Domain;

use App\Blog\User\Domain\UserPassword;
use Faker\Factory;
use Tests\Shared\Domain\Builder;

final class UserPasswordBuilder implements Builder
{
    private string $value;

    public function __construct()
    {
        $this->value = Factory::create()->password;
    }

    public function withValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function build(): UserPassword
    {
        return new UserPassword($this->value);
    }
}
