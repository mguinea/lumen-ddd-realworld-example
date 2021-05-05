<?php

namespace App\Shared\Domain\Traversables\Traits;

trait CollectionAccess
{
    public function add($item)
    {
        $this->offsetSet(null, $item);

        return $this;
    }

    public function get(string $key, $default = null)
    {
        $item = $this->offsetGet($key);

        if ($item === null) {
            return $default;
        }

        return $item;
    }

    public function set(string $key, $item)
    {
        $this->offsetSet($key, $item);
    }

    public function exists($key): bool
    {
        return $this->offsetExists($key);
    }

    public function remove(string $key)
    {
        $this->offsetUnset($key);
    }

    public function pull(string $key)
    {
        if ($this->exists($key)) {
            $item = $this->get($key);
            $this->remove($key);
            return $item;
        }

        return null;
    }
}
