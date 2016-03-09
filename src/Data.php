<?php

namespace PhpCollectionJson;

class Data extends CollectionJsonObject
{
    public function __construct($name, $value)
    {
        parent::__construct(
            'name',
            'value',
            'prompt'
        );
        $this->name = $name;
        $this->value = $value;
    }
}
