<?php

namespace PhpCollectionJson;

use PhpCollectionJson\Groups\QueryGroup;

class Document implements \JsonSerializable
{
    private $collection;
    private $error;
    private $template;
    private $queries;

    public function __construct()
    {
        $this->collection = null;
        $this->error = null;
        $this->template = null;
        $this->queries = new QueryGroup();
    }
    /**
     * @param Collection $collection
     */
    public function setCollection(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     *
     */
    public function removeCollection()
    {
        $this->collection = null;
    }

    /**
     * @param Error $error
     */
    public function setError(Error $error)
    {
        $this->error = $error;
    }

    /**
     *
     */
    public function removeError()
    {
        $this->error = null;
    }

    /**
     * @param Template $template
     */
    public function setTemplate(Template $template)
    {
        $this->template = $template;
    }

    /**
     *
     */
    public function removeTemplate()
    {
        $this->template = null;
    }

    /**
     * @return QueryGroup
     */
    public function getQueries()
    {
        return $this->queries;
    }

    public function jsonSerialize()
    {
        $object = new \stdClass();

        if (!is_null($this->collection)) {
            $object->collection = $this->collection;
        }

        if (!is_null($this->error)) {
            $object->error = $this->error;
        }

        if (!is_null($this->template)) {
            $object->template = $this->template;
        }

        if ($this->queries->count() > 0) {
            $object->queries = $this->queries;
        }

        return $object;
    }

    public function __toString()
    {
        return json_encode($this);
    }
}
