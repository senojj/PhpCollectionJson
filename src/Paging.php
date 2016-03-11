<?php

namespace PhpCollectionJson;

class Paging extends CollectionJsonObject
{
    /**
     * Paging constructor.
     * @param $totalItems
     * @param $totalPages
     * @param $page
     */
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
