<?php
    /**
     * @author Francisco Javier González Sabariego
     * 
     * La clase plataformas se encarga de gestionar las consultas a la BBDD pertenecientes a la categoría de plataformas
     */

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
         * 
         * @return Number Total de categorías almacenadas en la BBDD
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
         * Devuelve el ID de una categoría buscada por nombre
         * 
         * @param String $name Nombre de la categoría buscada
         * 
         * @return Number ID de la categoría
         */
        public function getCategoryIdByName($name) {
            $this->query = "SELECT id FROM keysbank_platform_categories WHERE category = :category";

            $this->parametros['category'] = $name;

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows[0]['id'];
        }

        /**
         * Devuelve una lista de plataformas y su correspondiente subcategoría para la categoría
         * seleccionada por su id.
         * 
         * @param Number $id ID de la categoría
         * 
         * @return Array Lista de plataformas, y su correspondiente subcategoría,
         *                  pertenecientes a la categoría pasada por parámetro
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
         * 
         * @param Number $id ID de la categoría
         * 
         * @return Array Lista de plataformas que pertenecen a la categoría buscada
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
         * 
         * @param Number $id ID de la categoría
         * 
         * @return Array Lista con las subcategorías pertenecientes a la categoría seleccionada
         */
        public function getSubcategoriesList($id) {
            $this->query = "SELECT id, idCategory, subcategory FROM keysbank_platform_subcategories WHERE idCategory = :id";

            $this->parametros['id'] = $id;

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        /**
         * Valida la existencia de una subcategoría pasando por parámetros
         * el id de la propia subcategoría y la categoría a la que pertenece
         * 
         * IMPORTANTE: La función de éste método es para evitar datos por haberse manipulado
         *              el árbol DOM en el lado del cliente. Se trata de una validación del
         *              lado del servidor.
         * 
         * @param Number $idCategory    ID de la categoría a la que debe pertenecer la subcategoría
         * @param Number $idSubcategory ID de la subcategoría a comprobar
         * 
         * @return Boolean True si la subcategoría pertenece a la categoría
         */
        public function validateSubcategory($idCategory, $idSubcategory) {
            $this->query = "SELECT * FROM keysbank_platform_subcategories WHERE idCategory = :idCategory AND id = :idSubcategory";

            $this->parametros['idCategory']    = $idCategory;
            $this->parametros['idSubcategory'] = $idSubcategory;

            $this->get_results_from_query();
            $this->close_connection();

            return sizeof($this->rows);
        }

        /**
         * Devuelve una lista con todas las plataformas ordenadas por: categorías, subcategorías y nombre de plataforma
         * 
         * @return Array
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
         * Devuelve la plataforma buscada por nombre similar a la búsqueda realizada
         * 
         * @param String $search Nombre de la plataforma
         * 
         * @return Array
         */
        public function getPlatformBySimilarName( $search ) {
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

        /**
         * Devuelve la plataforma buscada por nombre exacto
         * 
         * @param String $search Nombre de la plataforma
         * 
         * @return Array
         */
        public function getPlatformByName($search) {
            $this->query = "SELECT P.id, C.category, S.subcategory, P.name 
                            FROM keysbank_platform_categories C, keysbank_platform_subcategories S, keysbank_platforms_list P
                            WHERE C.id = P.idCategory
                            AND S.idCategory = P.idCategory
                            AND S.id = P.idSubcategory
                            AND P.name = :search
                            ORDER BY C.category, S.subcategory, P.name";
            
            $this->parametros['search'] = $search;

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        /**
         * Devuelve la plataforma buscada por ID
         * 
         * @param Number $id ID de la plataforma
         * 
         * @return Array
         */
        public function getPlatformById($id) {
            $this->query = "SELECT P.id, C.category, S.subcategory, P.name 
                            FROM keysbank_platform_categories C, keysbank_platform_subcategories S, keysbank_platforms_list P
                            WHERE C.id = P.idCategory
                            AND S.idCategory = P.idCategory
                            AND S.id = P.idSubcategory
                            AND P.id = :id
                            ORDER BY C.category, S.subcategory, P.name";
            
            $this->parametros['id'] = $id;

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        /**
         * Añade una nueva plataforma a la lista de plataformas
         * 
         * @param Array $platform_data Datos de la nueva plataforma
         */
        public function setPlatform( $platform_data = array() ) {
            $this->query = "INSERT INTO keysbank_platforms_list (idCategory,idSubcategory,name) 
                            VALUES (:idCategory,:idSubcategory,:name)";
            
            $this->parametros['idCategory']    = $platform_data['idCategory'];
            $this->parametros['idSubcategory'] = $platform_data['idSubcategory'];
            $this->parametros['name']          = $platform_data['name'];

            $this->get_results_from_query();
            $this->close_connection();
        }

        /**
         * Actualiza los datos de una plataforma
         * 
         * IMPORTANTE: Entre los datos que recibe el método no se incluye el ID de la categoría.
         *              Ésto es así porque en ningún momento se puede actualizar la categoría
         *              de una plataforma, ya que, del ID de la categoría depende la llave 
         *              de cifrado de las cuentas y, en caso de cambiarlo, las cuentas ya registradas
         *              para dicha plataforma no podrían descifrar los datos cifrados.
         * 
         * @param Array $platform_data Datos actualizados de la plataforma
         */
        public function updatePlatform( $platform_data = array() ) {
            $this->query = "UPDATE keysbank_platforms_list 
                            SET idSubcategory = :idSubcategory, name = :name WHERE id = :id";

            $this->parametros['id']            = $platform_data['id'];
            $this->parametros['idSubcategory'] = $platform_data['idSubcategory'];
            $this->parametros['name']          = $platform_data['name'];

            $this->get_results_from_query();
            $this->close_connection();
        }

        /**
         * Borra una plataforma de la lista de plataformas
         * 
         * @param Number $id ID de la plataforma que se desea eliminar
         */
        public function deletePlatform( $id ) {
            $this->query = "DELETE FROM keysbank_platforms_list WHERE id = :id";
            
            $this->parametros['id'] = $id;

            $this->get_results_from_query();
            $this->close_connection();
        }
    }
    
?>