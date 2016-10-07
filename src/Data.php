<?php

namespace PhpCollectionJson;

class Data implements \JsonSerializable
{
    private $name;
    private $value;
    private $prompt;

    /**
     * Data constructor.
     * @param string $name
     * @param string $value
     * @param string $prompt
     */
    public function __construct($name, $value, $prompt = '')
    {
        $this->name = $name;
        $this->value = $value;
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
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
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

    public function jsonSerialize()
    {
        $object = new \stdClass();
        $object->name = $this->name;
        $object->value = $this->value;

        if (!is_null($this->prompt) && strlen(trim($this->prompt)) > 0) {
            $object->prompt = $this->prompt;
        }

        return $object;
    }

    public function __toString()
    {
        return json_encode($this);
    }
}
