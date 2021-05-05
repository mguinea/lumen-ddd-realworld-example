<?php

namespace App\Shared\Domain\Traversables\Traits;

trait Iterator
{
    public function current()
    {
        return current($this->items);
    }

    public function next()
    {
        return next($this->items);
    }

    public function key()
    {
        return key($this->items);
    }

    public function valid(): bool
    {
        $key = key($this->items);

        return $key !== null && $key != false;
    }

    public function rewind()
    {
        reset($this->items);
    }
}
