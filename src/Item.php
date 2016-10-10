<?php

namespace PhpCollectionJson;

use PhpCollectionJson\Exceptions\ExpectedArrayException;
use PhpCollectionJson\Exceptions\FromArrayCompilationException;
use PhpCollectionJson\Exceptions\MissingArgumentException;
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

    /**
     * @param array $array
     * @return Item
     * @throws FromArrayCompilationException
     */
    public static function fromArray(array $array)
    {
        $href = null;

        if (array_key_exists('href', $array)) {
            $href = $array['href'];
        } else {
            throw new MissingArgumentException('href');
        }
        $item = new self($href);

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
                        $item->getData()->add(Data::fromArray($dataArray));
                    } catch (FromArrayCompilationException $e) {
                        throw new FromArrayCompilationException($key, $e->getMessage());
                    }
                }
            } catch (FromArrayCompilationException $e) {
                throw new FromArrayCompilationException('data', $e->getMessage());
            }
        }

        if (array_key_exists('links', $array)) {

            if (!is_array($array['links'])) {
                throw new ExpectedArrayException('links', gettype($array['links']));
            }

            try {

                foreach ($array['links'] as $key => $linkArray) {

                    if (!is_array($linkArray)) {
                        throw new ExpectedArrayException($key, gettype($linkArray));
                    }

                    try {
                        $item->getLinks()->add(Link::fromArray($linkArray));
                    } catch (FromArrayCompilationException $e) {
                        throw new FromArrayCompilationException($key, $e->getMessage());
                    }
                }
            } catch (FromArrayCompilationException $e) {
                throw new FromArrayCompilationException('links', $e->getMessage());
            }
        }

        return $item;
    }
}
