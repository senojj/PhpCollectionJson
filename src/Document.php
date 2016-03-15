<?php

namespace PhpCollectionJson;

class Document extends CollectionJsonObject
{
    /**
     * @param Collection $collection
     */
    public function setCollection(Collection $collection)
    {
        $this->data = ['collection' => $collection];
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
        $this->data = ['error' => $error];
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
        $this->data = ['template' => $template];
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
            $this->data['queries'] = [];
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
                $this->data['queries'] = array_values($this->data['queries']);
                $found = true;
            }
        }

        if (!count($this->data['queries'])) {
            unset($this->data['queries']);
        }

        return $found;
    }
}
