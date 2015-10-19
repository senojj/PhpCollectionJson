<?php namespace PhpCollectionJson;

    class DuplicateObjectException extends \Exception {

        function __construct ( $message = '', \Exception $previous = null ) {
            parent::__construct( $message, 808, $previous );
        }
    }
?>
