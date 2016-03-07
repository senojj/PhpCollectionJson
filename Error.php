<?php

namespace PhpCollectionJson;

class Error extends CollectionJsonObject
{
    public function __construct()
    {
        parent::__construct(
            'title',
            'code',
            'message'
        );
    }
}
