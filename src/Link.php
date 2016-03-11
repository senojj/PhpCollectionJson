<?php

namespace PhpCollectionJson;

class Link extends CollectionJsonObject
{
    /**
     * Link constructor.
     * @param $href
     * @param $rel
     */
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
