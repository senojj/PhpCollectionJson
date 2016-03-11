<?php

namespace PhpCollectionJson;

class Document extends CollectionJsonObject
{
    /**
     * @param Collection $collection
     */
    public function setCollection(Collection $collection)
    {
        $this->data = array('collection' => $collection);
    }

    public function unsetCollection()
    {
        unset($this->data['collection']);
    }

    /**
     * @param Error $error
     */
    public function setError(Error $error)
    {
        $this->data = array('error' => $error);
    }

    public function unsetError()
    {
        unset($this->data['error']);
    }

    /**
     * @param Template $template
     */
    public function setTemplate(Template $template)
    {
        $this->data = array('template' => $template);
    }

    public function unsetTemplate()
    {
        unset($this->data['template']);
    }

    /**
     * @param Query $query
     * @return $this
     * @throws DuplicateObjectException
     */
    public function addQuery(Query $query)
    {
        if (!array_key_exists('queries', $this->data)) {
            $this->data['queries'] = array();
        }

        if (!in_array($query, $this->data['queries'])) {
            $this->data['queries'][] = $query;
        } else {
            throw new DuplicateObjectException('Attempted to add duplicate Query to Document');
        }

        return $this;
    }

    /**
     * @param Query $query
     * @return bool
     */
    public function removeQuery(Query $query)
    {
        if (!array_key_exists('queries', $this->data)) {
            return false;
        }

        $found = false;

        for ($i = 0; $i < count($this->data['queries']); ++$i) {

            if ($query == $this->data['queries'][$i]) {
                unset($this->data['queries'][$i]);
                $found = true;
            }
        }

        if (!count($this->data['queries'])) {
            unset($this->data['queries']);
        }

        return $found;
    }
}
