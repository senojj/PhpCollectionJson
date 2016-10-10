<?php

namespace PhpCollectionJson;

use PhpCollectionJson\Exceptions\ExpectedArrayException;
use PhpCollectionJson\Exceptions\FromArrayCompilationException;
use PhpCollectionJson\Exceptions\MissingArgumentException;
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

    /**
     * @param array $array
     * @return Template
     * @throws FromArrayCompilationException
     */
    public static function fromArray(array $array)
    {
        $template = new self();

        if (!array_key_exists('data', $array)) {
            throw new MissingArgumentException('data');
        }

        try {

            foreach ($array['data'] as $key => $dataArray) {

                if (!is_array($dataArray)) {
                    throw new ExpectedArrayException($key, gettype($dataArray));
                }

                try {
                    $template->getData()->add(Data::fromArray($dataArray));
                } catch (FromArrayCompilationException $e) {
                    throw new FromArrayCompilationException($key, $e->getMessage());
                }
            }
        } catch (FromArrayCompilationException $e) {
            throw new FromArrayCompilationException('data', $e->getMessage());
        }

        return $template;
    }
}
