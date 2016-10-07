<?php

namespace PhpCollectionJson\Groups\Iterators;

use PhpCollectionJson\Item;

class ItemIterator implements \Iterator
{
    private $iterator;

    /**
     * ItemIterator constructor.
     * @param \Iterator $iterator
     */
    public function __construct(\Iterator $iterator)
    {
        $this->iterator = $iterator;
    }

    /**
     * @return Item
     */
    public function current()
    {
        return $this->iterator->current();
    }

    /**
     * @return int
     */
    public function key()
    {
        return $this->iterator->key();
    }

    /**
     *
     */
    public function next()
    {
        $this->iterator->next();
    }

    /**
     *
     */
    public function rewind()
    {
        $this->iterator->rewind();
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return $this->iterator->valid();
    }
}