<?php

namespace PhpCollectionJson;

class Paging extends CollectionJsonObject
{
    public function __construct($totalItems, $totalPages, $page)
    {
        parent::__construct(
            'totalItems',
            'totalPages',
            'page'
        );

        $this->totalItems = $totalItems;
        $this->totalPages = $totalPages;
        $this->page = $page;
    }
}
