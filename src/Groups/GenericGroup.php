<?php

namespace PhpCollectionJson\Groups;

use PhpCollectionJson\Groups\Iterators\GenericIterator;

class GenericGroup implements \IteratorAggregate, \JsonSerializable
{
    private $items;

    /**
     * GenericGroup constructor.
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * @param mixed $object
     */
    public function add($object)
    {
        $this->items[] = $object;
    }

    /**
     * @param mixed $object
     * @return bool
     */
    public function remove($object)
    {
        $found = false;

        for ($i = count($this->items); $i > -1; $i--) {

            if ($this->items[$i] == $object) {
                unset($this->items[$i]);
                $found = true;
            }
        }
        $this->items = array_values($this->items);

        return $found;
    }

    /**
     * @param mixed $object
     * @return bool
     */
    public function contains($object)
    {
        return in_array($object, $this->items);
    }

    /**
     *
     */
    public function clear()
    {
        $this->items = [];
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * @param int $index
     * @return mixed
     */
    public function elementAt($index)
    {
        if (!isset($this->items[$index])) {
            throw new \OutOfRangeException('Index is out of range');
        }

        return $this->items[$index];
    }

    /**
     * @param callable $callback
     */
    public function each(callable $callback)
    {
        for ($i = 0, $len = count($this->items); $i < $len; $i++) {
            $callback($this->items[$i]);
        }
    }

    public function getIterator()
    {
        return new GenericIterator($this->items);
    }

    public function jsonSerialize()
    {
        return $this->items;
    }
}