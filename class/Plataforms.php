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

        private function selectQuerySubcategories($id) {
            switch ($id) {
                case 1:
                    return "";
                case 2:
                    return "SELECT DPT.type, DPL.name FROM keysbank_digital_plataforms_list DPL, keysbank_digital_plataforms_type DPT WHERE DPL.idType = DPT.id ORDER BY DPT.type, DPL.name";
                case 3:
                    return "";
                case 4:
                    return "";
                case 5:
                    return "";
                case 6:
                    return "";
                /* default:
                    return ""; */
            }
        }

        public function getSubcategoriesList($id) {
            $this->query = $this->selectQuerySubcategories($id);

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }
    }
    
?>