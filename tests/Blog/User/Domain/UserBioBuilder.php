<?php

declare(strict_types=1);

namespace Tests\Blog\User\Domain;

use App\Blog\User\Domain\UserBio;
use Faker\Factory;
use Tests\Shared\Domain\Builder;

final class UserBioBuilder implements Builder
{
    private string $value;

    public function __construct()
    {
        $this->value = Factory::create()->text;
    }

    public function withValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function build(): UserBio
    {
        return new UserBio($this->value);
    }
}
