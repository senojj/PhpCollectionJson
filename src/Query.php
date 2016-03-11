<?php

namespace PhpCollectionJson;

class Query extends CollectionJsonObject
{
    /**
     * Query constructor.
     * @param $href
     * @param $rel
     */
    public function __construct($href, $rel)
    {
        parent::__construct(
            'href',
            'rel',
            'name',
            'prompt',
            'data'
        );
        $this->href = $href;
        $this->rel = $rel;
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
            case 'rel':
                $this->data[$name] = $value;
                break;
            case 'name':
                $this->data[$name] = $value;
                break;
            case 'prompt':
                $this->data[$name] = $value;
                break;
            default:
                break;
        }
    }

    /**
     * @param Data $data
     * @return $this
     * @throws DuplicateObjectException
     */
    public function addData(Data $data)
    {
        if (!array_key_exists('data', $this->data)) {
            $this->data['data'] = array();
        }

        if (!in_array($data, $this->data['data'])) {
            $this->data['data'][] = $data;
        } else {
            throw new DuplicateObjectException('Attempted to add duplicate Data to Query');
        }

        return $this;
    }

    /**
     * @param Data $data
     * @return bool
     */
    public function removeData(Data $data)
    {
        if (!array_key_exists('data', $this->data)) {
            return false;
        }

        $found = false;

        for ($i = 0; $i < count($this->data['data']); ++$i) {

            if ($data == $this->data['data'][$i]) {
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
