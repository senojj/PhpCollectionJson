<?php

namespace PhpCollectionJson\Groups;

use PhpCollectionJson\Groups\Iterators\LinkIterator;
use PhpCollectionJson\Link;

class LinkGroup implements \IteratorAggregate, \JsonSerializable
{
    private $group;

    /**
     * Group constructor.
     * @param Link[] $items
     */
    public function __construct(array $items = [])
    {
        $this->group = new GenericGroup($items);
    }

    /**
     * @param Link $object
     * @return LinkGroup
     */
    public function add(Link $object)
    {
        $this->group->add($object);

        return $this;
    }

    /**
     * @param Link $object
     * @return bool
     */
    public function remove(Link $object)
    {
        return $this->group->remove($object);
    }

    /**
     * @param Link $object
     * @return bool
     */
    public function contains(Link $object)
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
     * @return Link
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
     * @return LinkIterator
     */
    public function getIterator()
    {
        return new LinkIterator($this->group->getIterator());
    }

    public function jsonSerialize()
    {
        return $this->group;
    }
}