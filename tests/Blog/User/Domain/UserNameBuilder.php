<?php

declare(strict_types=1);

namespace Tests\Blog\User\Domain;

use App\Blog\User\Domain\UserName;
use Faker\Factory;
use Tests\Shared\Domain\Builder;

final class UserNameBuilder implements Builder
{
    private string $value;

    public function __construct()
    {
        $this->value = Factory::create()->userName;
    }

    public function withValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function build(): UserName
    {
        return new UserName($this->value);
    }
}
