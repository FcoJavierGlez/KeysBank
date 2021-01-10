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
        public function getTotalPlataformCategories() {
            $this->query = "SELECT id FROM keysbank_plataform_categories";

            $this->get_results_from_query();
            $this->close_connection();

            return sizeof($this->rows);
        }

        /**
         * Devuelve el conjunto de plataformas registradas en la BBDD
         */
        public function getPlataformCategories() {
            $this->query = "SELECT * FROM keysbank_plataform_categories";

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        public function getPlataformsByCategory($id) {
            $this->query = $this->selectQueryPlataforms($id);

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        private function selectQueryPlataforms($id) {
            switch ($id) {
                case 1:
                    return "SELECT SMS.subcategory, SML.name 
                            FROM keysbank_social_media_list SML, keysbank_social_media_subcategories SMS 
                            WHERE SML.idSubcategory = SMS.id 
                            ORDER BY SMS.subcategory, SML.name";
                case 2:
                    return "SELECT DPS.subcategory, DPL.name 
                            FROM keysbank_digital_plataforms_list DPL, keysbank_digital_plataforms_subcategories DPS 
                            WHERE DPL.idSubcategory = DPS.id 
                            ORDER BY DPS.subcategory, DPL.name";
                case 3:
                    return "SELECT WAS.subcategory, WAL.name 
                            FROM keysbank_webs_apps_list WAL, keysbank_webs_apps_subcategories WAS 
                            WHERE WAL.idSubcategory = WAS.id 
                            ORDER BY WAS.subcategory, WAL.name";
                case 4:
                    return "SELECT MS.subcategory, ML.name 
                            FROM keysbank_mails_list ML, keysbank_mails_subcategories MS 
                            WHERE ML.idSubcategory = MS.id 
                            ORDER BY MS.subcategory, ML.name";
                case 5:
                    return "SELECT OSS.subcategory, OSL.name 
                            FROM keysbank_operating_systems_list OSL, keysbank_operating_systems_subcategories OSS 
                            WHERE OSL.idSubcategory = OSS.id 
                            ORDER BY OSS.subcategory, OSL.name";
                case 6:
                    return "SELECT PSS.subcategory, PSL.name 
                            FROM keysbank_payments_systems_list PSL, keysbank_payments_systems_subcategories PSS 
                            WHERE PSL.idSubcategory = PSS.id 
                            ORDER BY PSS.subcategory, PSL.name";
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

        private function selectQuerySubcategories($id) {
            switch ($id) {
                case 1:
                    return "SELECT subcategory FROM keysbank_social_media_subcategories";
                case 2:
                    return "SELECT subcategory FROM keysbank_digital_plataforms_subcategories";
                case 3:
                    return "SELECT subcategory FROM keysbank_webs_apps_subcategories";
                case 4:
                    return "SELECT subcategory FROM keysbank_mails_subcategories";
                case 5:
                    return "SELECT subcategory FROM keysbank_operating_systems_subcategories";
                case 6:
                    return "SELECT subcategory FROM keysbank_payment_systems_subcategories";
                /* default:
                    return ""; */
            }
        }
    }
    
?>