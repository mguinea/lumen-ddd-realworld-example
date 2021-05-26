<?php

declare(strict_types=1);

namespace Tests\Auth\User\Domain;

use App\Shared\Domain\User\UserEmail;
use Faker\Factory;
use Tests\Shared\Domain\Builder;

final class UserEmailBuilder implements Builder
{
    private string $value;

    public function __construct()
    {
        $this->value = Factory::create()->email;
    }

    public function withValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function build(): UserEmail
    {
        return UserEmail::fromValue($this->value);
    }
}
