<?php

namespace PhpCollectionJson\Groups\Iterators;

use PhpCollectionJson\Query;

class QueryIterator implements \Iterator
{
    private $iterator;

    /**
     * QueryIterator constructor.
     * @param \Iterator $iterator
     */
    public function __construct(\Iterator $iterator)
    {
        $this->iterator = $iterator;
    }

    /**
     * @return Query
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