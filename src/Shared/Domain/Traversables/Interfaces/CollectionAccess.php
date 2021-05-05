<?php

namespace App\Shared\Domain\Traversables\Interfaces;

interface CollectionAccess
{
    /**
     * Add an item to the collection.
     *
     * @param  mixed  $item
     * @return mixed
     */
    public function add($item);

    /**
     * Whether an item exists
     *
     * @param $key
     * @return bool
     */
    public function exists($key): bool;

    /**
     * Get an item from the collection by key.
     *
     * @param string $key
     * @param null $default
     * @return mixed
     */
    public function get(string $key, $default = null);

    /**
     * @param string $key
     * @return mixed
     */
    public function remove(string $key);

    /**
     * @param string $key
     * @param $item
     * @return mixed
     */
    public function set(string $key, $item);
}
