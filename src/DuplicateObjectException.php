<?php

namespace PhpCollectionJson;

class DuplicateObjectException extends \Exception
{
    /**
     * DuplicateObjectException constructor.
     * @param string $message
     * @param \Exception|null $previous
     */
    public function __construct($message = '', \Exception $previous = null)
    {
        parent::__construct($message, 808, $previous);
    }
}
