<?php

namespace PhpCollectionJson\Exceptions;

class FromArrayCompilationException extends \Exception
{
    public function __construct($key, $message)
    {
        parent::__construct('[' . $key . ']' . $message);
    }
}