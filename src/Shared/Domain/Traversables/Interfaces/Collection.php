<?php

namespace App\Shared\Domain\Traversables\Interfaces;

use App\Blog\Shared\Domain\Tag\Tags;
use ArrayAccess;
use Countable;
use Iterator;

interface Collection extends ArrayAccess, Countable, Iterator
{
    /**
     * Create a new instance with provided items.
     *
     * @param array $items
     * @return static
     */
    public static function create(array $items = []): self;

    /**
     * Execute a callback over each item.
     *
     * @param  callable  $callback
     * @return $this
     */
    public function each(callable $callback);

    /**
     * Create a new instance with no items.
     *
     * @return static
     */
    public static function empty(): self;

    /**
     * Run a filter over each of the items.
     *
     * @param  callable|null  $callback
     * @return static
     */
    public function filter(callable $callback = null): self;

    /**
     * Get all of the items in the collection.
     *
     * @return array
     */
    public function items(): array;

    /**
     * Run a map over each of the items.
     *
     * @param  callable  $callback
     * @return static
     */
    public function map(callable $callback): self;
}
