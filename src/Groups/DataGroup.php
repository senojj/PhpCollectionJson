<?php

namespace PhpCollectionJson\Groups;

use PhpCollectionJson\Groups\Iterators\DataIterator;
use PhpCollectionJson\Data;

class DataGroup implements \IteratorAggregate, \JsonSerializable
{
    private $group;

    /**
     * Group constructor.
     * @param Data[] $items
     */
    public function __construct(array $items = [])
    {
        $this->group = new UniqueGroup($items);
    }

    /**
     * @param Data $object
     * @return DataGroup
     */
    public function add(Data $object)
    {
        $duplicates = [];

        $this->group->each(function (Data $data) use ($duplicates, $object) {

            if ($data->getName() === $object->getName()) {
                $duplicates[] = $data;
            }
        });

        foreach ($duplicates as $duplicate) {
            $this->remove($duplicate);
        }

        $this->group->add($object);

        return $this;
    }

    /**
     * @param Data $object
     * @return bool
     */
    public function remove(Data $object)
    {
        return $this->group->remove($object);
    }

    /**
     * @param Data $object
     * @return bool
     */
    public function contains(Data $object)
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
     * @return Data
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
     * @return DataIterator
     */
    public function getIterator()
    {
        return new DataIterator($this->group->getIterator());
    }

    public function jsonSerialize()
    {
        return $this->group;
    }
}