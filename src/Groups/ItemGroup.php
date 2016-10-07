<?php

namespace PhpCollectionJson\Groups;

use PhpCollectionJson\Groups\Iterators\ItemIterator;
use PhpCollectionJson\Item;

class ItemGroup implements \IteratorAggregate, \JsonSerializable
{
    private $group;

    /**
     * Group constructor.
     * @param Item[] $items
     */
    public function __construct(array $items = [])
    {
        $this->group = new GenericGroup($items);
    }

    /**
     * @param Item $object
     * @return ItemGroup
     */
    public function add(Item $object)
    {
        $this->group->add($object);

        return $this;
    }

    /**
     * @param Item $object
     * @return bool
     */
    public function remove(Item $object)
    {
        return $this->group->remove($object);
    }

    /**
     * @param Item $object
     * @return bool
     */
    public function contains(Item $object)
    {
        return $this->group->contains($object);
    }

    /**
     *
     */
    public function clear()
    {
        $this->group->clear();
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->group->count();
    }

    /**
     * @param int $index
     * @return Item
     */
    public function elementAt($index)
    {
        return $this->group->elementAt($index);
    }

    /**
     * @param callable $callback
     */
    public function each(callable $callback)
    {
        $this->group->each($callback);
    }

    /**
     * @return ItemIterator
     */
    public function getIterator()
    {
        return new ItemIterator($this->group->getIterator());
    }

    public function jsonSerialize()
    {
        return $this->group;
    }
}