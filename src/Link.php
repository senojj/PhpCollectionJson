<?php

namespace PhpCollectionJson;

class Link implements \JsonSerializable
{
    private $href;
    private $rel;
    private $prompt;
    private $name;
    private $render;

    /**
     * Link constructor.
     * @param string $href
     * @param string $rel
     * @param string $name
     * @param string $prompt
     * @param string $render
     */
    public function __construct($href, $rel, $name = '', $prompt = '', $render = '')
    {
        $this->href = $href;
        $this->rel = $rel;
        $this->prompt = $prompt;
        $this->name = $name;
        $this->render = $render;
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
    public function getRender()
    {
        return $this->render;
    }

    /**
     * @param string $render
     */
    public function setRender($render)
    {
        $this->render = $render;
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

        if (!is_null($this->render) && strlen(trim($this->render)) > 0) {
            $object->render = $this->render;
        }

        return $object;
    }
}
