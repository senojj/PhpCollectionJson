<?php namespace PhpCollectionJson;

    class Collection extends CollectionJsonObject {

        function __construct ( $href ) {
            $this->data['version'] = '1.0';
            $this->data['href'] = $href;
            $this->data['items'] = array();

            parent::__construct(
                'version',
                'href',
                'links',
                'items',
                'queries',
                'template',
                'error'
            );
        }

        function __set ( $name, $value ) {
            $this->verifyProperty( $name );

            switch ( $name ) {
                case 'version':
                    $this->data[$name] = $value;
                    break;
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

        function __isset ( $name ) {
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

        public function removeLink( Link $link ) {

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

        public function addItem ( Item $item ) {

            if ( !array_key_exists( 'items', $this->data ) ) {
                $this->data['items'] = array();
            }

            if ( !in_array( $item, $this->data['items'] ) ) {
                $this->data['items'][] = $item;
            }
            else {
                throw new DuplicateObjectException( 'Attempted to add duplicate Item to Collection');
            }
            return $this;
        }

        public function removeItem ( Item $item ) {

            if ( !array_key_exists( 'items', $this->data ) ) {
                return;
            }

            for ( $i = 0; $i < count( $this->data['items'] ); $i++ ) {

                if ( $item == $this->data['items'][$i] ) {
                    unset( $this->data['items'][$i] );
                }
            }

            if ( !count( $this->data['items'] ) ) {
                unset( $this->data['items'] );
            }
        }
    }

?>
