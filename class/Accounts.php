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
                $this->query = "SELECT A.id,A.idCategory,A.name_platform,AES_DECRYPT(UNHEX(A.name_account),K.password) 
                FROM keysbank_accounts A, keysbank_keys K 
                WHERE K.idUser = A.idUser
                AND K.idCategory = A.idCategory
                AND A.idUser = :idUser";
            }
            else {
                $this->query = "SELECT A.id,A.name_platform,AES_DECRYPT(UNHEX(A.name_account),K.password) 
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
         * Devuelve el total de cuentas del usuario
         */
        public function getAccountById($idUser, $idAccount) {
            $this->query = "SELECT A.id,A.name_platform,AES_DECRYPT(UNHEX(A.name_account),K.password),
            AES_DECRYPT(UNHEX(A.pass_account),K.password),A.url,A.info 
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
         * Devuelve el total de cuentas del usuario
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
    }
    
?>