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
                $this->query = "SELECT A.id,A.idCategory,A.name_platform,AES_DECRYPT(UNHEX(A.name_account),K.password),AES_DECRYPT(UNHEX(A.notes),K.password)
                FROM keysbank_accounts A, keysbank_keys K 
                WHERE K.idUser = A.idUser
                AND K.idCategory = A.idCategory
                AND A.idUser = :idUser";
            }
            else {
                $this->query = "SELECT A.id,A.name_platform,AES_DECRYPT(UNHEX(A.name_account),K.password),AES_DECRYPT(UNHEX(A.notes),K.password) 
                FROM keysbank_accounts A, keysbank_keys K 
                WHERE K.idUser = A.idUser
                AND K.idCategory = A.idCategory
                AND A.idUser = :idUser
                AND lower(A.name_platform) LIKE :search";
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
            $this->query = "SELECT A.id,A.idCategory,A.name_platform,
            AES_DECRYPT(UNHEX(A.name_account),K.password),
            AES_DECRYPT(UNHEX(A.pass_account),K.password),
            AES_DECRYPT(UNHEX(A.url),K.password),
            AES_DECRYPT(UNHEX(A.info),K.password),
            AES_DECRYPT(UNHEX(A.notes),K.password)
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
         * Inserta una nueva cuenta
         */
        public function setPassAccount($data = array()) {
            $this->query = "INSERT INTO keysbank_accounts 
            (idUser,idCategory,name_account,pass_account,name_platform,url,info,notes)
            VALUES
            (:idUser,
            :idCategory,
            HEX(AES_ENCRYPT(:name_account,(SELECT password FROM keysbank_keys WHERE idUser = :idUser AND idCategory = :idCategory))),
            HEX(AES_ENCRYPT(:pass_account,(SELECT password FROM keysbank_keys WHERE idUser = :idUser AND idCategory = :idCategory))),
            :name_platform,
            HEX(AES_ENCRYPT(:url,(SELECT password FROM keysbank_keys WHERE idUser = :idUser AND idCategory = :idCategory))),
            HEX(AES_ENCRYPT(:info,(SELECT password FROM keysbank_keys WHERE idUser = :idUser AND idCategory = :idCategory))),
            HEX(AES_ENCRYPT(:notes,(SELECT password FROM keysbank_keys WHERE idUser = :idUser AND idCategory = :idCategory))) )";

            $this->parametros['idUser']        = $data['idUser'];
            $this->parametros['idCategory']    = $data['idCategory'];
            $this->parametros['name_account']  = $data['name_account'];
            $this->parametros['pass_account']  = $data['pass_account'];
            $this->parametros['name_platform'] = $data['name_platform'];
            $this->parametros['url']           = $data['url'];
            $this->parametros['info']          = $data['info'];
            $this->parametros['notes']         = $data['notes'];

            $this->get_results_from_query();
            $this->close_connection();
        }
    }
    
?>