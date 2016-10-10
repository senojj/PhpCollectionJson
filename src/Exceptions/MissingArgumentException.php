<?php

namespace PhpCollectionJson\Exceptions;

class MissingArgumentException extends FromArrayCompilationException
{
    public function __construct($key)
    {
        parent::__construct($key, ' is missing');
    }
}