<?php

namespace PhpCollectionJson\Exceptions;

class ExpectedArrayException extends FromArrayCompilationException
{
    public function __construct($key, $receivedType)
    {
        parent::__construct($key, ' expected array, got: ' . $receivedType);
    }
}