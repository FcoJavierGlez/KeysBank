<?php

    class Plataforms extends DBAbstractModel {

        private static $_instancia;

        public function __construct() {

        }
        
        public static function singleton() {
            if (!isset(self::$_instancia)) {
                $miClase = __CLASS__;
                self::$_instancia = new $miClase;
            }
            return self::$_instancia;
        }

        public function __clone() {
            trigger_error('La clonación no es permitida.', E_USER_ERROR);
        }

        /**
         * Devuelve el número de plataformas
         */
        public function getTotalNumberPlataforms() {
            $this->query = "SELECT id FROM keysbank_plataforms";

            $this->get_results_from_query();
            $this->close_connection();

            return sizeof($this->rows);
        }

        /**
         * Devuelve el conjunto de plataformas registradas en la BBDD
         */
        public function getPlataforms() {
            $this->query = "SELECT * FROM keysbank_plataforms";

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }
    }
    
?>