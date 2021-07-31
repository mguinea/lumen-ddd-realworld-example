<?php

declare(strict_types=1);

namespace App\Blog\Tag\Domain;

final class Tag
{
    private TagId $id;
    private TagValue $value;

    public function __construct(TagId $id, TagValue $value)
    {
        $this->id = $id;
        $this->value = $value;
    }

    public static function fromPrimitives(string $id, string $value): self
    {
        return new self(
            TagId::fromValue($id),
            TagValue::fromValue($value)
        );
    }

    public function id(): TagId
    {
        return $this->id;
    }

    public function value(): TagValue
    {
        return $this->value;
    }
}
