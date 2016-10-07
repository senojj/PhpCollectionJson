<?php

namespace PhpCollectionJson\Groups\Iterators;

class GenericIterator implements \Iterator
{
    private $items = [];
    private $position = 0;

    /**
     * GenericIterator constructor.
     * @param array $items
     */
    public function __construct(array $items)
    {
        $counter = 0;

        foreach ($items as $item) {
            $this->items[$counter] = $item;
            $counter++;
        }
        $this->position = 0;
    }

    /**
     * @return mixed
     */
    public function current()
    {
        if (!$this->valid()) {
            throw new \OutOfRangeException('Position is out of range.');
        }

        return $this->items[$this->position];
    }

    /**
     * @return int
     */
    public function key()
    {
        return $this->position;
    }

    /**
     *
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     *
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return isset($this->items[$this->position]);
    }
}