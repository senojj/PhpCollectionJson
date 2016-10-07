<?php

namespace PhpCollectionJson;

use PhpCollectionJson\Groups\DataGroup;
use PhpCollectionJson\Groups\LinkGroup;

class Item implements \JsonSerializable
{
    private $href;
    private $data;
    private $links;

    /**
     * Item constructor.
     * @param string $href
     */
    public function __construct($href)
    {
        $this->href = $href;
        $this->data = new DataGroup();
        $this->links = new LinkGroup();
    }

    /**
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @param string $href
     */
    public function setHref($href)
    {
        $this->href = $href;
    }

    /**
     * @return DataGroup
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return LinkGroup
     */
    public function getLinks()
    {
        return $this->links;
    }

    public function jsonSerialize()
    {
        $object = new \stdClass();
        $object->href = $this->href;

        if ($this->data->count() > 0) {
            $object->data = $this->data;
        }

        if ($this->links->count() > 0) {
            $object->links = $this->links;
        }

        return $object;
    }

    public function __toString()
    {
        return json_encode($this);
    }
}
