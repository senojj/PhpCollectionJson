<?php namespace PhpCollectionJson;

    class Item extends CollectionJsonObject {

        function __construct ( $href ) {
            $this->data['href'] = $href;

            parent::__construct(
                'href',
                'data',
                'links'
            );
        }

        function __set ( $name, $value ) {
            $this->verifyProperty( $name );

            switch ( $name ) {
                case 'href':
                    $this->data[$name] = $value;
                    break;
                default:
                    break;
            }
        }

        function __get ( $name ) {
            $this->verifyProperty( $name );

            if ( array_key_exists( $name, $this->data ) ) {
                return $this->data[$name];
            }
            else {
                return null;
            }
        }

        function __isset( $name ) {
            return isset( $this->data[$name] );
        }

        public function addLink ( Link $link ) {

            if ( !array_key_exists( 'links', $this->data ) ) {
                $this->data['links'] = array();
            }

            if ( !in_array( $link, $this->data['links'] ) ) {
                $this->data['links'][] = $link;
            }
            else {
                throw new DuplicateObjectException( 'Attempted to add duplicate Link to Item' );
            }
            return $this;
        }

        public function removeLink ( Link $link ) {

            if ( !array_key_exists( 'links', $this->data ) ) {
                return;
            }

            for ( $i = 0; $i < count( $this->data['links'] ); $i++ ) {

                if ( $link == $this->data['links'][$i] ) {
                    unset( $this->data['links'][$i] );
                }
            }

            if ( !count( $this->data['links'] ) ) {
                unset( $this->data['links'] );
            }
        }

        public function addData ( Data $data ) {

            if ( !array_key_exists( 'data', $this->data ) ) {
                $this->data['data'] = array();
            }

            if ( !in_array( $data, $this->data['data'] ) ) {
                $this->data['data'][] = $data;
            }
            else {
                throw new DuplicateObjectException( 'Attempted to add duplicate Data to Item' );
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
