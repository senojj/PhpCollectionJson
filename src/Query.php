<?php

namespace PhpCollectionJson;

use PhpCollectionJson\Groups\DataGroup;

class Query implements \JsonSerializable
{
    private $href;
    private $rel;
    private $name;
    private $prompt;
    private $data;

    /**
     * Query constructor.
     * @param string $href
     * @param string $rel
     * @param string $name
     * @param string $prompt
     */
    public function __construct($href, $rel, $name = '', $prompt = '')
    {
        $this->href = $href;
        $this->rel = $rel;
        $this->name = $name;
        $this->prompt = $prompt;
        $this->data = new DataGroup();
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
     * @return string
     */
    public function getRel()
    {
        return $this->rel;
    }

    /**
     * @param string $rel
     */
    public function setRel($rel)
    {
        $this->rel = $rel;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPrompt()
    {
        return $this->prompt;
    }

    /**
     * @param string $prompt
     */
    public function setPrompt($prompt)
    {
        $this->prompt = $prompt;
    }

    /**
     * @return DataGroup
     */
    public function getData()
    {
        return $this->data;
    }

    public function jsonSerialize()
    {
        $object = new \stdClass();
        $object->href = $this->href;
        $object->rel = $this->rel;

        if (!is_null($this->name) && strlen(trim($this->name)) > 0) {
            $object->name = $this->name;
        }

        if (!is_null($this->prompt) && strlen(trim($this->prompt)) > 0) {
            $object->prompt = $this->prompt;
        }

        if ($this->data->count() > 0) {
            $object->data = $this->data;
        }

        return $object;
    }

    public function __toString()
    {
        return json_encode($this);
    }
}
