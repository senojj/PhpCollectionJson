<?php

namespace PhpCollectionJson;

class Template extends CollectionJsonObject
{
    public function __construct()
    {
        parent::__construct(
            'data'
        );
    }

    public static function process($obj)
    {
        if (!isset($obj->template)) {
            throw new \InvalidArgumentException('Object does not contain a template');
        }
        $template = $obj->template;

        if (!isset($template->data)) {
            throw new \InvalidArgumentException('Template does not contain any data');
        }
        $obj = new \stdClass();

        foreach ($template->data as $data) {

            if (!isset($data->name)) {
                throw new \InvalidArgumentException('Template Data object does not contain a name property');
            }

            if (!isset($data->value)) {
                $data->value = null;
            }
            $obj->{$data->name} = $data->value;
        }

        return $obj;
    }

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

    public function removeData($name)
    {
        if (!array_key_exists('data', $this->data)) {
            return false;
        }

        for ($i = 0; $i < count($this->data['data']); ++$i) {

            if ($data->name === $this->data['data'][$i]->name) {
                unset($this->data['data'][$i]);
            }
        }

        if (!count($this->data['data'])) {
            unset($this->data['data']);
        }
    }
}
