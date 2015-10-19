<?php namespace PhpCollectionJson;

    class Error extends CollectionJsonObject {

        function __construct () {

            parent::__construct(
                'title',
                'code',
                'message'
            );
        }

        function __set ( $name, $value ) {
            $this->verifyProperty( $name );
            $this->data[$name] = $value;
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
    }

?>