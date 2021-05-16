<?php

    class Platforms extends DBAbstractModel {

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
         * Devuelve el total de categorías almacenada en la base de datos
         */
        public function getTotalPlatformCategories() {
            $this->query = "SELECT id FROM keysbank_platform_categories";

            $this->get_results_from_query();
            $this->close_connection();

            return sizeof($this->rows);
        }

        /**
         * Devuelve el conjunto de categorías registradas en la BBDD:
         * digital_platform, social_media, etc
         */
        public function getPlatformCategories() {
            $this->query = "SELECT * FROM keysbank_platform_categories";

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        /**
         * Devuelve una lista de plataformas y su correspondiente subcategoría para la categoría
         * seleccionada por su id.
         */
        public function getPlatformsByCategory($id) {
            $this->query = "SELECT C.category, S.subcategory, P.name 
                            FROM keysbank_platform_categories C, keysbank_platform_subcategories S, keysbank_platforms_list P
                            WHERE C.id = P.idCategory
                            AND S.idCategory = P.idCategory
                            AND S.id = P.idSubcategory
                            AND C.id = :id
                            ORDER BY S.subcategory, P.name";

            $this->parametros['id'] = $id;

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

         /**
         * Devuelve una lista con el nombre de plataformas para la categoría seleccionada por su id.
         */
        public function getPlatformsListByCategory($id) {
            $this->query = "SELECT P.name 
                            FROM keysbank_platform_categories C, keysbank_platforms_list P
                            WHERE C.id = P.idCategory
                            AND C.id = :id
                            ORDER BY P.name";

            $this->parametros['id'] = $id;

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        /**
         * Devuelve una lista de subcategorías para la categoría seleccionada por su id.
         */
        public function getSubcategoriesList($id) {
            $this->query = "SELECT subcategory FROM keysbank_platform_subcategories WHERE idCategory = :id";

            $this->parametros['id'] = $id;

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        /**
         * Devuelve una lista con todas las plataformas ordenadas por: categorías, subcategorías y nombre de plataforma
         */
        public function getPlatformsList() {
            $this->query = "SELECT P.id, C.category, S.subcategory, P.name 
                            FROM keysbank_platform_categories C, keysbank_platform_subcategories S, keysbank_platforms_list P
                            WHERE C.id = P.idCategory
                            AND S.idCategory = P.idCategory
                            AND S.id = P.idSubcategory
                            ORDER BY C.category, S.subcategory, P.name";

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        /**
         * Devuelve la plataforma buscada por nombre
         */
        public function getPlatformByName($search) {
            $this->query = "SELECT P.id, C.category, S.subcategory, P.name 
                            FROM keysbank_platform_categories C, keysbank_platform_subcategories S, keysbank_platforms_list P
                            WHERE C.id = P.idCategory
                            AND S.idCategory = P.idCategory
                            AND S.id = P.idSubcategory
                            AND P.name LIKE :search
                            ORDER BY C.category, S.subcategory, P.name";
            
            $this->parametros['search'] = '%'.$search.'%';

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

    }
    
?>