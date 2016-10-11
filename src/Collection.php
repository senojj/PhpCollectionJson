<?php

namespace PhpCollectionJson;

use PhpCollectionJson\Exceptions\ExpectedArrayException;
use PhpCollectionJson\Exceptions\FromArrayCompilationException;
use PhpCollectionJson\Exceptions\MissingArgumentException;
use PhpCollectionJson\Groups\ItemGroup;
use PhpCollectionJson\Groups\LinkGroup;
use PhpCollectionJson\Groups\QueryGroup;

class Collection implements \JsonSerializable
{
    private $version;
    private $href;
    private $links;
    private $items;
    private $queries;
    private $template;
    private $error;
    private $paging;

    /**
     * Collection constructor.
     * @param string $href
     * @param string $version
     */
    public function __construct($href, $version = '1.0')
    {
        $this->version = $version;
        $this->href = $href;
        $this->links = new LinkGroup();
        $this->items = new ItemGroup();
        $this->queries = new QueryGroup();
        $this->template = null;
        $this->error = null;
        $this->paging = null;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
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
     * @return LinkGroup
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @return ItemGroup
     */
    public function getItems()
    {
        return $this->items;
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

    /**
     * @param Paging $paging
     */
    public function setPaging(Paging $paging)
    {
        $this->paging = $paging;
    }

    /**
     *
     */
    public function removePaging()
    {
        $this->paging = null;
    }

    public function jsonSerialize()
    {
        $object = new \stdClass();
        $object->version = $this->version;
        $object->href = $this->href;

        if ($this->links->count() > 0) {
            $object->links = $this->links;
        }

        if ($this->items->count() > 0) {
            $object->items = $this->items;
        }

        if ($this->queries->count() > 0) {
            $object->queries = $this->queries;
        }

        if (!is_null($this->template)) {
            $object->template = $this->template;
        }

        if (!is_null($this->error)) {
            $object->error = $this->error;
        }

        if (!is_null($this->paging)) {
            $object->paging = $this->paging;
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
     * @return Collection
     * @throws FromArrayCompilationException
     */
    public static function fromArray(array $array, $strict = true)
    {
        $href = '';
        $version = '1.0';

        if (array_key_exists('href', $array)) {
            $href = $array['href'];
        } elseif ($strict) {
            throw new MissingArgumentException('href');
        }

        if (array_key_exists('version', $array)) {
            $version = $array['version'];
        }
        $collection = new self($href, $version);

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
                        $collection->getLinks()->add(Link::fromArray($linkArray, $strict));
                    } catch (FromArrayCompilationException $e) {
                        throw new FromArrayCompilationException($key, $e->getMessage());
                    }
                }
            } catch (FromArrayCompilationException $e) {
                throw new FromArrayCompilationException('links', $e->getMessage());
            }
        }

        if (array_key_exists('items', $array)) {

            if (!is_array($array['items'])) {
                throw new ExpectedArrayException('items', gettype($array['items']));
            }

            try {

                foreach ($array['items'] as $key => $itemArray) {

                    if (!is_array($itemArray)) {
                        throw new ExpectedArrayException($key, gettype($itemArray));
                    }

                    try {
                        $collection->getItems()->add(Item::fromArray($itemArray, $strict));
                    } catch (FromArrayCompilationException $e) {
                        throw new FromArrayCompilationException($key, $e->getMessage());
                    }
                }
            } catch (FromArrayCompilationException $e) {
                throw new FromArrayCompilationException('items', $e->getMessage());
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
                        $collection->getQueries()->add(Query::fromArray($queryArray, $strict));
                    } catch (FromArrayCompilationException $e) {
                        throw new FromArrayCompilationException($key, $e->getMessage());
                    }
                }
            } catch (FromArrayCompilationException $e) {
                throw new FromArrayCompilationException('queries', $e->getMessage());
            }
        }

        if (array_key_exists('template', $array)) {

            if (!is_array($array['template'])) {
                throw new ExpectedArrayException('template', gettype($array['template']));
            }

            try {
                $collection->setTemplate(Template::fromArray($array['template'], $strict));
            } catch (FromArrayCompilationException $e) {
                throw new FromArrayCompilationException('template', $e->getMessage());
            }
        }

        if (array_key_exists('error', $array)) {

            if (!is_array($array['error'])) {
                throw new ExpectedArrayException('error', gettype($array['error']));
            }

            try {
                $collection->setError(Error::fromArray($array['error']));
            } catch (FromArrayCompilationException $e) {
                throw new FromArrayCompilationException('error', $e->getMessage());
            }
        }

        if (array_key_exists('paging', $array)) {

            if (!is_array($array['paging'])) {
                throw new ExpectedArrayException('paging', gettype($array['paging']));
            }

            try {
                $collection->setPaging(Paging::fromArray($array['paging'], $strict));
            } catch (FromArrayCompilationException $e) {
                throw new FromArrayCompilationException('paging', $e->getMessage());
            }
        }

        return $collection;
    }
}
