<?php

namespace PhpCollectionJson;

class Paging implements \JsonSerializable
{
    private $totalItems;
    private $totalPages;
    private $page;

    /**
     * Paging constructor.
     * @param int $totalItems
     * @param int $totalPages
     * @param int $page
     */
    public function __construct($totalItems, $totalPages, $page)
    {
        $this->totalItems = $totalItems;
        $this->totalPages = $totalPages;
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getTotalItems()
    {
        return $this->totalItems;
    }

    /**
     * @param int $totalItems
     */
    public function setTotalItems($totalItems)
    {
        $this->totalItems = $totalItems;
    }

    /**
     * @return int
     */
    public function getTotalPages()
    {
        return $this->totalPages;
    }

    /**
     * @param int $totalPages
     */
    public function setTotalPages($totalPages)
    {
        $this->totalPages = $totalPages;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    public function jsonSerialize()
    {
        $object = new \stdClass();
        $object->totalItems = $this->totalItems;
        $object->totalPages = $this->totalPages;
        $object->page = $this->page;

        return $object;
    }

    public function __toString()
    {
        return json_encode($this);
    }
}
