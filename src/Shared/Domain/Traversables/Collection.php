<?php

declare(strict_types=1);

namespace App\Shared\Domain\Traversables;

use App\Shared\Domain\Traversables\Interfaces\CollectionAccess as CollectionAccessInterface;
use App\Shared\Domain\Traversables\Interfaces\Collection as CollectionInterface;
use App\Shared\Domain\Traversables\Traits\ArrayAccess;
use App\Shared\Domain\Traversables\Traits\CollectionAccess;
use App\Shared\Domain\Traversables\Traits\Count;
use App\Shared\Domain\Traversables\Traits\Iterator;

abstract class Collection implements CollectionInterface, CollectionAccessInterface
{
    use ArrayAccess;
    use CollectionAccess;
    use Count;
    use Iterator;

    protected array $items;

    /**
     * @throws InvalidCollectionObjectException
     */
    protected function __construct(array $items = [])
    {
        foreach ($items as $item) {
            if (false === is_a($item, $this->itemsType())) {
                throw new InvalidCollectionObjectException($item, $this->itemsType());
            }
        }

        $this->items = $items;
    }

    /**
     * @throws InvalidCollectionObjectException
     */
    public static function create(array $items = []): CollectionInterface
    {
        return new static($items);
    }

    abstract protected function itemsType(): string;

    public function each(callable $callback): Collection
    {
        foreach ($this as $key => $item) {
            if ($callback($item, $key) === false) {
                break;
            }
        }

        return $this;
    }

    /**
     * @throws InvalidCollectionObjectException
     */
    public static function empty(): CollectionInterface
    {
        return self::create();
    }

    /**
     * @throws InvalidCollectionObjectException
     */
    public function filter(callable $callback = null): CollectionInterface
    {
        if ($callback) {
            return new static(
                array_filter($this->items, $callback, ARRAY_FILTER_USE_BOTH)
            );
        }

        return new static(array_filter($this->items));
    }

    public function items(): array
    {
        return $this->items;
    }

    /**
     * @throws InvalidCollectionObjectException
     */
    public function map(callable $callback): CollectionInterface
    {
        $keys = array_keys($this->items);
        $items = array_map($callback, $this->items, $keys);

        return new static(array_combine($keys, $items));
    }
}
