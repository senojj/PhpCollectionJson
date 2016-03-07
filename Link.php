<?php

namespace PhpCollectionJson;

class Link extends CollectionJsonObject
{
    public function __construct($href, $rel)
    {
        parent::__construct(
            'href',
            'rel',
            'prompt',
            'name',
            'render'
        );
        $this->rel = $rel;
        $this->href = $href;
    }
}
