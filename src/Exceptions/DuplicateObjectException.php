<?php

namespace PhpCollectionJson\Exceptions;

class DuplicateObjectException extends \Exception
{
    /**
     * DuplicateObjectException constructor.
     * @param \Exception|null $previous
     */
    public function __construct(\Exception $previous = null)
    {
        parent::__construct('Duplicate object encountered', 808, $previous);
    }
}
