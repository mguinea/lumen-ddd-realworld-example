<?php

namespace App\Blog\Tag\Domain;

use App\Blog\Shared\Domain\Tag\Tags;

interface TagRepository
{
    public function all(): Tags;
}
