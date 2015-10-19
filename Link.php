<?php namespace PhpCollectionJson;

    class Link extends CollectionJsonObject {

        function __construct ( $href, $rel ) {
            $this->data['rel'] = $rel;
            $this->data['href'] = $href;

            parent::__construct(
                'href',
                'rel',
                'prompt',
                'name',
                'render'
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

        function __isset ( $name ) {
            return isset( $this->data[$name] );
        }
    }

?>
