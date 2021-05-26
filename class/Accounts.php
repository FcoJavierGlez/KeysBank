<?php

    class Accounts extends DBAbstractModel {

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
         * Devuelve el total de cuentas del usuario
         */
        public function getUserAccounts($idUser, $search = '') {
            if ($search == '' || $search == '*') {
                $this->query = "SELECT P.name, A.id,A.idCategory,C.category,A.idPlatform,AES_DECRYPT(UNHEX(A.name_account),K.password),DATEDIFF(CURDATE(), A.pass_date),AES_DECRYPT(UNHEX(A.notes),K.password)
                FROM keysbank_accounts A, keysbank_keys K, keysbank_platform_categories C, keysbank_platforms_list P
                WHERE K.idUser = A.idUser
                AND K.idCategory = A.idCategory
                AND C.id = A.idCategory
                AND A.idUser = :idUser
                AND P.id = A.idPlatform";
            }
            else {
                $this->query = "SELECT P.name, A.id,A.idCategory,C.category,A.idPlatform,AES_DECRYPT(UNHEX(A.name_account),K.password),DATEDIFF(CURDATE(), A.pass_date),AES_DECRYPT(UNHEX(A.notes),K.password) 
                FROM keysbank_accounts A, keysbank_keys K, keysbank_platform_categories C, keysbank_platforms_list P
                WHERE K.idUser = A.idUser
                AND K.idCategory = A.idCategory
                AND C.id = A.idCategory
                AND A.idUser = :idUser
                AND P.id = A.idPlatform
                AND lower(P.name) LIKE :search";
            }

            $this->parametros['idUser'] = $idUser;
            $this->parametros['search'] = '%'.$search.'%';

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        /**
         * Devuelve la cuenta del usuario buscada por id de cuenta e id de usuario
         */
        public function getAccountById($idUser, $idAccount) {
            $this->query = "SELECT P.name,A.id,A.idCategory,A.idPlatform,
                            AES_DECRYPT(UNHEX(A.name_account),K.password),
                            AES_DECRYPT(UNHEX(A.pass_account),K.password),
                            DATEDIFF(CURDATE(), A.pass_date),
                            AES_DECRYPT(UNHEX(A.url),K.password),
                            AES_DECRYPT(UNHEX(A.info),K.password),
                            AES_DECRYPT(UNHEX(A.notes),K.password)
                            FROM keysbank_accounts A, keysbank_keys K, keysbank_platforms_list P 
                            WHERE K.idUser = A.idUser
                            AND K.idCategory = A.idCategory
                            AND A.id = :idAccount
                            AND A.idUser = :idUser
                            AND P.id = A.idPlatform";

            $this->parametros['idUser']    = $idUser;
            $this->parametros['idAccount'] = $idAccount;

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        /**
         * Devuelve la contraseña de una cuenta del usuario
         */
        public function getPassAccountById($idUser, $idAccount) {
            $this->query = "SELECT AES_DECRYPT(UNHEX(A.pass_account),K.password)
            FROM keysbank_accounts A, keysbank_keys K 
            WHERE K.idUser = A.idUser
            AND K.idCategory = A.idCategory
            AND A.id = :idAccount
            AND A.idUser = :idUser";

            $this->parametros['idUser']    = $idUser;
            $this->parametros['idAccount'] = $idAccount;

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        /**
         * Devuelve la información adicional de una cuenta del usuario
         */
        public function getInfoAccountById($idUser, $idAccount) {
            $this->query = "SELECT AES_DECRYPT(UNHEX(A.info),K.password)
            FROM keysbank_accounts A, keysbank_keys K 
            WHERE K.idUser = A.idUser
            AND K.idCategory = A.idCategory
            AND A.id = :idAccount
            AND A.idUser = :idUser";

            $this->parametros['idUser']    = $idUser;
            $this->parametros['idAccount'] = $idAccount;

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        /**
         * Inserta una nueva cuenta
         * 
         * @param Array $data Conjunto de datos necesarios para insertar una nueva cuenta
         */
        public function addAccount($data = array()) {
            $this->query = "INSERT INTO keysbank_accounts 
            (idUser,idCategory,idPlatform,name_account,pass_account,pass_date,url,info,notes)
            VALUES
            (:idUser,
            :idCategory,
            :idPlatform,
            HEX(AES_ENCRYPT(:name_account,(SELECT password FROM keysbank_keys WHERE idUser = :idUser AND idCategory = :idCategory))),
            HEX(AES_ENCRYPT(:pass_account,(SELECT password FROM keysbank_keys WHERE idUser = :idUser AND idCategory = :idCategory))),
            :pass_date,
            HEX(AES_ENCRYPT(:url,(SELECT password FROM keysbank_keys WHERE idUser = :idUser AND idCategory = :idCategory))),
            HEX(AES_ENCRYPT(:info,(SELECT password FROM keysbank_keys WHERE idUser = :idUser AND idCategory = :idCategory))),
            HEX(AES_ENCRYPT(:notes,(SELECT password FROM keysbank_keys WHERE idUser = :idUser AND idCategory = :idCategory))) )";

            $this->parametros['idUser']        = $data['idUser'];
            $this->parametros['idCategory']    = $data['idCategory'];
            $this->parametros['idPlatform']    = $data['idPlatform'];
            $this->parametros['name_account']  = $data['name_account'];
            $this->parametros['pass_account']  = $data['pass_account'];
            $this->parametros['pass_date']     = $data['pass_date'];
            $this->parametros['url']           = $data['url'];
            $this->parametros['info']          = $data['info'];
            $this->parametros['notes']         = $data['notes'];

            $this->get_results_from_query();
            $this->close_connection();
        }

        /**
         * Actualiza una cuenta
         * 
         * @param Array $data Conjunto de datos necesarios para actualizar los datos de la cuenta
         */
        public function updateAccount($data = array()) {
            $this->query = "UPDATE keysbank_accounts 
            SET 
            idPlatform = :idPlatform,
            name_account = HEX(AES_ENCRYPT(:name_account,(SELECT password FROM keysbank_keys WHERE idUser = :idUser AND idCategory = :idCategory))),
            pass_account = HEX(AES_ENCRYPT(:pass_account,(SELECT password FROM keysbank_keys WHERE idUser = :idUser AND idCategory = :idCategory))),
            url = HEX(AES_ENCRYPT(:url,(SELECT password FROM keysbank_keys WHERE idUser = :idUser AND idCategory = :idCategory))),
            info = HEX(AES_ENCRYPT(:info,(SELECT password FROM keysbank_keys WHERE idUser = :idUser AND idCategory = :idCategory))),
            notes = HEX(AES_ENCRYPT(:notes,(SELECT password FROM keysbank_keys WHERE idUser = :idUser AND idCategory = :idCategory)))
            WHERE id = :idAccount";

            $this->parametros['idUser']        = $data['idUser'];
            $this->parametros['idAccount']     = $data['idAccount'];
            $this->parametros['idCategory']    = $data['idCategory'];
            $this->parametros['name_account']  = $data['name_account'];
            $this->parametros['pass_account']  = $data['pass_account'];
            $this->parametros['idPlatform']    = $data['idPlatform'];
            $this->parametros['url']           = $data['url'];
            $this->parametros['info']          = $data['info'];
            $this->parametros['notes']         = $data['notes'];

            $this->get_results_from_query();
            $this->close_connection();
        }

        /**
         * Borra una cuenta determinada pasándole por parámetros el id del usuario propietario y el id de la cuenta
         * 
         * @param Number $idUser ID del usuario propietario de la cuenta
         * @param Number $idAccount ID de la cuenta
         */
        public function deleteAccount($idUser,$idAccount) {
            $this->query = "DELETE FROM keysbank_accounts WHERE id = :id AND idUser = :idUser";

            $this->parametros['id']     = $idAccount;
            $this->parametros['idUser'] = $idUser;

            $this->get_results_from_query();
            $this->close_connection();
        }

        /**
         * Devuelve el ID de la categoría a la que pertecene la cuenta
         */
        public function getIdCategoryByAccount($idAccount) {
            $this->query = "SELECT idCategory FROM keysbank_accounts WHERE id = :id";

            $this->parametros['id'] = $idAccount;

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows[0]['idCategory'];
        }

        /**
         * Devuelve una lista de cuentas propietarias del usuario que repiten el mismo nombre de cuenta
         */
        public function getAccountsUserByNameRepeat($idUser,$nameAccount) {
            $this->query = "SELECT A.id, AES_DECRYPT(UNHEX(A.name_account),K.password), A.name_platform
            FROM keysbank_accounts A, keysbank_keys K 
            WHERE K.idUser = A.idUser 
            AND K.idCategory = A.idCategory 
            AND A.idUser = :idUser
            AND LOWER(CONVERT(AES_DECRYPT(UNHEX(A.name_account),K.password) USING utf8)) = LOWER(:name_account)
            ORDER BY A.name_platform";

            $this->parametros['idUser']       = $idUser;
            $this->parametros['name_account'] = $nameAccount;

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

    }
    
?>