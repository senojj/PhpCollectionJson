<?php

namespace PhpCollectionJson\Groups;

use PhpCollectionJson\Groups\Iterators\QueryIterator;
use PhpCollectionJson\Query;

class QueryGroup implements \IteratorAggregate, \JsonSerializable
{
    private $group;

    /**
     * Group constructor.
     * @param Query[] $items
     */
    public function __construct(array $items = [])
    {
        $this->group = new GenericGroup($items);
    }

    /**
     * @param Query $object
     * @return QueryGroup
     */
    public function add(Query $object)
    {
        $this->group->add($object);

        return $this;
    }

    /**
     * @param Query $object
     * @return bool
     */
    public function remove(Query $object)
    {
        return $this->group->remove($object);
    }

    /**
     * @param Query $object
     * @return bool
     */
    public function contains(Query $object)
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
     * @return Query
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
     * @return QueryIterator
     */
    public function getIterator()
    {
        return new QueryIterator($this->group->getIterator());
    }

    public function jsonSerialize()
    {
        return $this->group;
    }
}