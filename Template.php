<?php namespace PhpCollectionJson;

    class Template extends CollectionJsonObject {

        function __construct () {

            parent::__construct(
                'data'
            );
        }

        public function addData ( Data $data ) {

            if ( !array_key_exists( 'data', $this->data ) ) {
                $this->data['data'] = array();
            }

            if ( !in_array( $data, $this->data['data'] ) ) {
                $this->data['data'][] = $data;
            }
            else {
                throw new DuplicateObjectException( 'Attempted to add duplicate Data to Template' );
            }
            return $this;
        }

        public function removeData ( Data $data ) {

            if ( !array_key_exists( 'data', $this->data ) ) {
                return;
            }

            for ( $i = 0; $i < count( $this->data['data'] ); $i++ ) {

                if ( $data == $this->data['data'][$i] ) {
                    unset( $this->data['data'][$i] );
                }
            }

            if ( !count( $this->data['data'] ) ) {
                unset( $this->data['data'] );
            }
        }
    }

?>
