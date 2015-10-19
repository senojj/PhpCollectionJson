<?php namespace PhpCollectionJson;

    class Document implements \JsonSerializable {
        private $data = array();

        public function setCollection ( Collection $collection ) {
            $this->data = array( 'collection' => $collection );
        }

        public function unsetCollection () {
            unset( $this->data['collection'] );
        }

        public function setError ( Error $error ) {
            $this->data = array( 'error' => $error );
        }

        public function unsetError () {
            unset( $this->data['error'] );
        }

        public function setTemplate ( Template $template ) {
            $this->data = array( 'template' => $template );
        }

        public function unsetTemplate () {
            unset( $this->data['template'] );
        }

        public function addQuery ( Query $query ) {

            if ( !array_key_exists( 'queries', $this->data ) ) {
                $this->data['queries'] = array();
            }

            if ( !in_array( $query, $this->data['queries'] ) ) {
                $this->data['queries'][] = $query;
            }
            else {
                throw new DuplicateObjectException( 'Attempted to add duplicate Query to Document');
            }
            return $this;
        }

        public function removeQuery ( Query $query ) {

            if ( !array_key_exists( 'queries', $this->data ) ) {
                return;
            }

            for ( $i = 0; $i < count( $this->data['queries'] ); $i++ ) {

                if ( $query == $this->data['queries'][$i] ) {
                    unset( $this->data['queries'][$i] );
                }
            }

            if ( !count( $this->data['queries'] ) ) {
                unset( $this->data['queries'] );
            }
        }

        public function jsonSerialize () {
            return (object)$this->data;
        }
    }

?>
