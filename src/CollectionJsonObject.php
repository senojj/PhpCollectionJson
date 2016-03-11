<?php

namespace PhpCollectionJson;

abstract class CollectionJsonObject implements \JsonSerializable
{
    protected $data = array();
    private $validProperties = array();

    public function __construct()
    {
        foreach (func_get_args() as $arg) {
            $this->validProperties[] = $arg;
        }
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->verifyProperty($name);
        $this->data[$name] = $value;
    }

    /**
     * @param $name
     * @return null
     */
    public function __get($name)
    {
        $this->verifyProperty($name);

        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        } else {
            return null;
        }
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        if (!in_array($name, $this->validProperties)) {
            return false;
        }

        return isset($this->data[$name]);
    }

    /**
     * @param $name
     */
    protected function verifyProperty($name)
    {
        if (!in_array($name, $this->validProperties)) {
            throw new \InvalidArgumentException('Type '.static::class." does not contain a property '$name'");
        }
    }

    public function jsonSerialize()
    {
        return (object) $this->data;
    }

    public function __toString()
    {
        return json_encode($this);
    }
}
