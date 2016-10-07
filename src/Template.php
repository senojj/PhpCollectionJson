<?php

namespace PhpCollectionJson;

use PhpCollectionJson\Groups\DataGroup;

class Template implements \JsonSerializable
{
    private $data;

    public function __construct()
    {
        $this->data = new DataGroup();
    }

    /**
     * @return DataGroup
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $array
     * @return Template
     */
    public static function fromArray(array $array)
    {
        $template = new self();

        if (array_key_exists('template', $array)) {
            $array = $array['template'];
        }

        if (!array_key_exists('data', $array)) {
            throw new \InvalidArgumentException('Template does not contain any data');
        }

        foreach ($array['data'] as $dataArray) {

            if (!array_key_exists('name', $dataArray)) {
                throw new \InvalidArgumentException('Template data object does not contain a name property');
            }
            $name = $dataArray['name'];
            $value = null;

            if (array_key_exists('value', $dataArray)) {
                $value = $dataArray['value'];
            }
            $data = new Data($name, $value);
            $template->getData()->add($data);
        }

        return $template;
    }

    /**
     * @param string $json
     * @return Template
     */
    public static function fromJSON($json)
    {
        $array = json_decode($json, true);

        return self::fromArray($array);
    }

    public function jsonSerialize()
    {
        $object = new \stdClass();
        $object->data = $this->data;

        return $object;
    }

    public function __toString()
    {
        return json_encode($this);
    }
}
