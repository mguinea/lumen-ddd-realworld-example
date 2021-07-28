<?php

declare(strict_types=1);

namespace App\Blog\Article\Domain;

use App\Shared\Domain\ValueObject\StringValueObject;

final class ArticleSlug extends StringValueObject
{
    public static function fromTitle(ArticleTitle $title): self
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title->value())));

        return new self($slug);
    }
}
