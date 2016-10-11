<?php

namespace PhpCollectionJson;

use PhpCollectionJson\Exceptions\ExpectedArrayException;
use PhpCollectionJson\Exceptions\FromArrayCompilationException;
use PhpCollectionJson\Exceptions\MissingArgumentException;
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

    /**
     * @param array $array
     * @param bool $strict
     * @return Query
     * @throws FromArrayCompilationException
     */
    public static function fromArray(array $array, $strict = true)
    {
        $href = '';
        $rel = '';
        $name = '';
        $prompt = '';

        if (array_key_exists('href', $array)) {
            $href = $array['href'];
        } elseif ($strict) {
            throw new MissingArgumentException('href');
        }

        if (array_key_exists('rel', $array)) {
            $rel = $array['rel'];
        } elseif ($strict) {
            throw new MissingArgumentException('rel');
        }

        if (array_key_exists('name', $array)) {
            $name = $array['name'];
        }

        if (array_key_exists('prompt', $array)) {
            $prompt = $array['prompt'];
        }
        $query = new self($href, $rel, $name, $prompt);

        if (array_key_exists('data', $array)) {

            if (!is_array($array['data'])) {
                throw new ExpectedArrayException('data', gettype($array['data']));
            }

            try {

                foreach ($array['data'] as $key => $dataArray) {

                    if (!is_array($dataArray)) {
                        throw new ExpectedArrayException($key, gettype($dataArray));
                    }

                    try {
                        $query->getData()->add(Data::fromArray($dataArray, $strict));
                    } catch (FromArrayCompilationException $e) {
                        throw new FromArrayCompilationException($key, $e->getMessage());
                    }
                }
            } catch (FromArrayCompilationException $e) {
                throw new FromArrayCompilationException('data', $e->getMessage());
            }
        }

        return $query;
    }
}
