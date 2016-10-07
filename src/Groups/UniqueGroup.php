<?php

namespace PhpCollectionJson\Groups;

use PhpCollectionJson\Exceptions\DuplicateObjectException;

class UniqueGroup implements \IteratorAggregate, \JsonSerializable
{
    private $group;

    /**
     * UniqueGroup constructor.
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->group = new GenericGroup($items);
    }

    /**
     * @param mixed $object
     * @throws DuplicateObjectException
     */
    public function add($object)
    {
        if ($this->contains($object)) {
            throw new DuplicateObjectException();
        }
        $this->group->add($object);
    }

    /**
     * @param mixed $object
     * @return bool
     */
    public function remove($object)
    {
        return $this->group->remove($object);
    }

    /**
     * @param mixed $object
     * @return bool
     */
    public function contains($object)
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
     * @return mixed
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

    public function getIterator()
    {
        return $this->group->getIterator();
    }

    public function jsonSerialize()
    {
        return $this->group;
    }
}