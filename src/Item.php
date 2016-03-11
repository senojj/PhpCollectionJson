<?php

namespace PhpCollectionJson;

class Item extends CollectionJsonObject
{
    /**
     * Item constructor.
     * @param $href
     */
    public function __construct($href)
    {
        parent::__construct(
            'href',
            'data',
            'links'
        );
        $this->href = $href;
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->verifyProperty($name);

        switch ($name) {
            case 'href':
                $this->data[$name] = $value;
                break;
            default:
                break;
        }
    }

    /**
     * @param Link $link
     * @return $this
     * @throws DuplicateObjectException
     */
    public function addLink(Link $link)
    {
        if (!array_key_exists('links', $this->data)) {
            $this->data['links'] = array();
        }

        if (!in_array($link, $this->data['links'])) {
            $this->data['links'][] = $link;
        } else {
            throw new DuplicateObjectException('Attempted to add duplicate Link to Item');
        }

        return $this;
    }

    /**
     * @param Link $link
     * @return bool
     */
    public function removeLink(Link $link)
    {
        if (!array_key_exists('links', $this->data)) {
            return false;
        }

        $found = false;

        for ($i = 0; $i < count($this->data['links']); ++$i) {

            if ($link == $this->data['links'][$i]) {
                unset($this->data['links'][$i]);
                $found = true;
            }
        }

        if (!count($this->data['links'])) {
            unset($this->data['links']);
        }

        return $found;
    }

    /**
     * @param Data $data
     * @return $this
     */
    public function addData(Data $data)
    {
        if (!array_key_exists('data', $this->data)) {
            $this->data['data'] = array();
        }

        for ($i = 0; $i < count($this->data['data']); ++$i) {
            if ($this->data['data'][$i]->name === $data->name) {
                unset($this->data['data'][$i]);
            }
        }
        $this->data['data'][] = $data;

        return $this;
    }

    /**
     * @param $name
     * @return bool
     */
    public function removeData($name)
    {
        if (!array_key_exists('data', $this->data)) {
            return false;
        }

        $found = false;

        for ($i = 0; $i < count($this->data['data']); ++$i) {

            if ($name === $this->data['data'][$i]->name) {
                unset($this->data['data'][$i]);
                $found = true;
            }
        }

        if (!count($this->data['data'])) {
            unset($this->data['data']);
        }

        return $found;
    }
}
