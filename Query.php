<?php namespace PhpCollectionJson;

    class Query extends CollectionJsonObject {

        function __construct ( $href, $rel ) {
            $this->data['href'] = $href;
            $this->data['rel'] = $rel;

            parent::__construct(
                'href',
                'rel',
                'name',
                'prompt',
                'data'
            );
        }

        function __set ( $name, $value ) {
            $this->verifyProperty( $name );

            switch ( $name ) {
                case 'href':
                    $this->data[$name] = $value;
                    break;
                case 'rel':
                    $this->data[$name] = $value;
                    break;
                case 'name':
                    $this->data[$name] = $value;
                    break;
                case 'prompt':
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

        public function addData ( Data $data ) {

            if ( !array_key_exists( 'data', $this->data ) ) {
                $this->data['data'] = array();
            }

            if ( !in_array( $data, $this->data['data'] ) ) {
                $this->data['data'][] = $data;
            }
            else {
                throw new DuplicateObjectException( 'Attempted to add duplicate Data to Query' );
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
