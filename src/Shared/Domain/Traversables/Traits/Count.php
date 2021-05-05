<?php

namespace App\Shared\Domain\Traversables\Traits;

use function count;

trait Count
{
    public function count(): int
    {
        return count($this->items);
    }
}
