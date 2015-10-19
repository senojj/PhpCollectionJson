<?php namespace PhpCollectionJson;

    abstract class CollectionJsonObject implements \JsonSerializable {
        protected $data = array();
        private $validProperties = array();

        function __construct () {

            foreach ( func_get_args() as $arg ) {
                $this->validProperties[] = $arg;
            }
        }

        protected function verifyProperty ( $name ) {

            if ( !in_array( $name, $this->validProperties ) ) {
                throw new \InvalidArgumentException( "Type " . __CLASS__ . " does not contain a property '$name'" );
            }
        }

        public function jsonSerialize () {
            return (object)$this->data;
        }

    }

?>
