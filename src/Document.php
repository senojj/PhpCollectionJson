<?php

namespace PhpCollectionJson;

use PhpCollectionJson\Exceptions\ExpectedArrayException;
use PhpCollectionJson\Exceptions\FromArrayCompilationException;
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
     * @return Collection|null
     */
    public function getCollection()
    {
        return $this->collection;
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
     * @return Error|null
     */
    public function getError()
    {
        return $this->error;
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
     * @return Template|null
     */
    public function getTemplate()
    {
        return $this->template;
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

    /**
     * @param array $array
     * @return Document
     * @throws FromArrayCompilationException
     */
    public static function fromArray(array $array)
    {
        $document = new self();

        if (array_key_exists('collection', $array)) {

            if (!is_array($array['collection'])) {
                throw new ExpectedArrayException('collection', gettype($array['collection']));
            }

            try {
                $document->setCollection(Collection::fromArray($array['collection']));
            } catch (FromArrayCompilationException $e) {
                throw new FromArrayCompilationException('collection', $e->getMessage());
            }
        }

        if (array_key_exists('error', $array)) {

            if (!is_array($array['error'])) {
                throw new ExpectedArrayException('error', gettype($array['error']));
            }

            try {
                $document->setError(Error::fromArray($array['error']));
            } catch (FromArrayCompilationException $e) {
                throw new FromArrayCompilationException('error', $e->getMessage());
            }
        }

        if (array_key_exists('template', $array)) {

            if (!is_array($array['template'])) {
                throw new ExpectedArrayException('template', gettype($array['template']));
            }

            try {
                $document->setTemplate(Template::fromArray($array['template']));
            } catch (FromArrayCompilationException $e) {
                throw new FromArrayCompilationException('template', $e->getMessage());
            }
        }

        if (array_key_exists('queries', $array)) {

            if (!is_array($array['queries'])) {
                throw new ExpectedArrayException('queries', gettype($array['queries']));
            }

            try {

                foreach ($array['queries'] as $key => $queryArray) {

                    if (!is_array($queryArray)) {
                        throw new ExpectedArrayException($key, gettype($queryArray));
                    }

                    try {
                        $document->getQueries()->add(Query::fromArray($queryArray));
                    } catch (FromArrayCompilationException $e) {
                        throw new FromArrayCompilationException($key, $e->getMessage());
                    }
                }
            } catch (FromArrayCompilationException $e) {
                throw new FromArrayCompilationException('queries', $e->getMessage());
            }
        }

        return $document;
    }

    /**
     * @param string $json
     * @return Document
     */
    public static function fromJSON($json)
    {
        $array = json_decode($json, true);

        return self::fromArray($array);
    }
}
