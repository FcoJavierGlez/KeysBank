<?php

    class Users extends DBAbstractModel {

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
         * Devuelve todos los usuarios de la tabla usuarios coincidan 
         * en nick o email a la búsqueda pasada como parámetro. 
         * 
         * En caso de no pasarle nada devolverá todos los usuarios con perfil 'USER'.
         * En caso de pasarle un asterisco devolverá toda la lista, incluyendo el perfil 'ADMIN'.
         */
        public function getUsers ($search = '') {
            if ($search == '')
                $this->query = "SELECT id, nick, email, perfil, current_state FROM keysbank_users WHERE perfil = 'USER'";
            elseif ($search == '*')
                $this->query = "SELECT id, nick, email, perfil, current_state FROM keysbank_users";
            else
                $this->query = "SELECT id, nick, email, perfil, current_state FROM keysbank_users 
                                WHERE perfil = 'USER' 
                                AND nick LIKE :search
                                OR email LIKE :search";

            $this->parametros['search'] = '%'.$search.'%';

            $this->get_results_from_query();
            $this->close_connection();
            
            return $this->rows;
        }

        /**
         * Devuelve el ID del usario buscado por nick
         */
        public function getIdUserByNick ( $id = 0 ) {
            if ( $id !== 0 ) {
                $this->query = "SELECT id FROM keysbank_users WHERE nick = lower( :nick )";

                $this->parametros['nick'] = strtolower( $id );

                $this->get_results_from_query();
                $this->close_connection();
            }

            return $this->rows[0]['id'];
        }

        /**
         * Busca usuario por nick
         */
        public function getUserByNick ( $nick = '' ) {
            if ( $nick !== '' ) {
                $this->query = "SELECT 
                U.id,
                U.nick,
                AES_DECRYPT(UNHEX(U.pass),K.password),
                AES_DECRYPT(UNHEX(U.name),K.password),
                AES_DECRYPT(UNHEX(U.surname),K.password),
                U.email,
                U.perfil,
                U.current_state,
                U.days_old_password
                FROM keysbank_users U, keysbank_keys K
                WHERE U.id = K.idUser and K.idCategory = 0 and U.id = (SELECT id FROM keysbank_users WHERE lower( nick ) = :nick)";

                $this->parametros['nick'] = strtolower( $nick );

                $this->get_results_from_query();
                $this->close_connection();
            }

            return $this->rows;
        }

        /**
         * Devuelve el usuario que coincida con el email
         */
        public function getUserByEmail( $email = '' ) {
            if ( $email !== '' ) {
                $this->query = "SELECT * FROM keysbank_users WHERE email = lower( :email )";

                $this->parametros['email'] = strtolower( $email );

                $this->get_results_from_query();
                $this->close_connection();
            }

            return $this->rows;
        }

        /**
         * Devuelve el usuario con el id pasado por parámetro
         */
        public function getUserById( $id ) {
            $this->query = "SELECT * FROM keysbank_users WHERE id = :id";

            $this->parametros['id'] = $id;

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        /**
         * Inserta un nuevo usuario en el sistema
         */
        public function setUser ( $user_data = array() ) {
            $idUser = 0;
            $generalKey = $this->_genKey();

            if ( sizeof( $this->getUserByNick( strtolower($user_data['nick']) ) ) )         //Si existe ese nick invalidamos el registro
                throw new UserExistException();
            elseif ( !preg_match('/^([^-_@()<>[\]\"\'\.,;:])\w+([^-_@()<>[\]\"\'\.,;:])@([^-_@()<>[\]\"\'\.,;:])+\.(com|es)$/', 
            $user_data['email']) )                                              //Si el email no cumple con el formato válido
                throw new MailFormatException();
            elseif ( sizeof( $this->getUserByEmail( strtolower($user_data['email']) ) ) )   //Si ya existe este email registrado
                throw new MailExistException();
            elseif ( $user_data['pass'] !== $user_data['pass2'])                //Si la contraseña y su verificación no coinciden
                throw new PassCheckException();
            else {
                $this->query = "INSERT INTO keysbank_users 
                                (
                                    keysbank_users.nick,
                                    keysbank_users.pass,
                                    keysbank_users.name,
                                    keysbank_users.surname,
                                    keysbank_users.email,
                                    keysbank_users.perfil,
                                    keysbank_users.current_state
                                ) 
                                VALUES (
                                    :nick,
                                    HEX(AES_ENCRYPT(:pass,:keypass)),
                                    HEX(AES_ENCRYPT(:username,:keypass)),
                                    HEX(AES_ENCRYPT(:surname,:keypass)),
                                    :email,
                                    :perfil,
                                    :current_state
                                )";

                $this->parametros['nick']          = strtolower($user_data['nick']);
                $this->parametros['pass']          = $user_data['pass'];
                $this->parametros['username']      = $user_data['name'];
                $this->parametros['surname']       = $user_data['surname'];
                $this->parametros['perfil']        = "USER";
                $this->parametros['current_state'] = "PENDING";
                $this->parametros['email']         = strtolower($user_data['email']);
                $this->parametros['keypass']       = $generalKey;  //Obtenemos la llave genérica (llave idCategory == 0)
                //$this->parametros['keypass']       = $user_data['keypass'];

                $this->get_results_from_query();
                $this->close_connection();

                //Una vez ingresado el usuario insertamos la llave general

                //Recuperamos el ID del usuario a partir de su nick
                $idUser = $this->getIdUserByNick( strtolower($user_data['nick']) );

                //E insertamos la llave general
                $this->_setUserKeys( $idUser, 0, $generalKey );
            }
        }

        /**
         * Inserta las llaves del usuario para las distintas plataformas
         */
        private function _setUserKeys( $idUser,$idCategory,$keypass ) {
            $this->query = "INSERT INTO keysbank_keys (keysbank_keys.idUser, keysbank_keys.idCategory, keysbank_keys.password) 
                                VALUES (:idUser, :idCategory, :keypass)";

            $this->parametros['idUser']      = $idUser;
            $this->parametros['idCategory']  = $idCategory;
            $this->parametros['keypass']     = $keypass;

            $this->get_results_from_query();
            $this->close_connection();
        }

        /**
         * 
         */
        public function editUser ( $user_data = array() ) {
            $userSearchByNick  = $this->getUserByNick($user_data['nick']);
            $userSearchByEmail = $this->getUserByEmail($user_data['email']);
            if ( sizeof( $userSearchByNick ) && $userSearchByNick[0]['id'] !== $user_data['id'] )   //Si otro usuario tiene el nuevo nick
                throw new UserExistException();
            elseif ( !preg_match('/^([^-_@()<>[\]\"\'\.,;:])\w+([^-_@()<>[\]\"\'\.,;:])@([^-_@()<>[\]\"\'\.,;:])+\.(com|es)$/', $user_data['email']) )  //Si el correo tiene un formato inválido                                            //Si el email no cumple con el formato válido
                throw new MailFormatException();
            elseif ( sizeof( $userSearchByEmail ) && $userSearchByEmail[0]['id'] !== $user_data['id'] ) //Si el nuevo correo ya está registrado
                throw new MailExistException();

            $this->query = "UPDATE keysbank_users
                            SET nick = :nick, 
                            name = HEX( AES_ENCRYPT( :name,(SELECT password FROM keysbank_keys WHERE idUser = :id AND idCategory = 0) ) ), 
                            surname = HEX( AES_ENCRYPT( :surname, (SELECT password FROM keysbank_keys WHERE idUser = :id AND idCategory = 0) ) ), 
                            email = :email, 
                            days_old_password = :days_old_password
                            WHERE id = :id";

            $this->parametros['id']                = $user_data['id'];
            $this->parametros['nick']              = $user_data['nick'];
            $this->parametros['name']              = $user_data['name'];
            $this->parametros['surname']           = $user_data['surname'];
            $this->parametros['email']             = $user_data['email'];
            $this->parametros['days_old_password'] = $user_data['days_old_password'];

            $this->get_results_from_query();
            $this->close_connection();
        }

        /**
         * Edita la contraseña de una cuenta de acceso a la aplicacción
         */
        public function editPass ( $user_data = array() ) {
            $oldPass = $this->getUserByNick( $user_data['nick'] )[0]['AES_DECRYPT(UNHEX(U.pass),K.password)'];
            if ( $oldPass !== $user_data['old_pass'] )      //Si la contraseña vieja no coincide con la alamacenada
                throw new CheckOldPassException();
            elseif ( $user_data['new_pass'] !== $user_data['new_pass2'])
                throw new PassCheckException();


            $this->query = "UPDATE keysbank_users
                SET pass = HEX( AES_ENCRYPT( :pass,(SELECT password FROM keysbank_keys WHERE idUser = :id AND idCategory = 0) ) )
                WHERE id = :id";

            $this->parametros['id'] = $user_data['id'];
            $this->parametros['pass'] = $user_data['new_pass'];

            $this->get_results_from_query();
            $this->close_connection();
        }

        /**
         * Edita el estado del usuario
         * 
         * @param String newState El nuevo estado que tendrá el usuario. Sólo dos posibles ['ACTIVATE','BANNED']
         * @param Number idUser   El ID del usuario que se va a actualizar
         */
        public function updateState( $newState, $idUser ) {
            $newState      = strtoupper( $newState );
            $current_state = $this->getUserById( $idUser )[0]['current_state'];
            $userKeys      = array();
            
            if ($newState == 'ACTIVE' && $current_state == 'PENDING') {
                //generamos las llaves del usuario para cada categoría
                $userKeys = $this->_genUserKeys( $_SESSION['instance_platforms']->getTotalPlatformCategories() );
                //insertar nuevas llaves
                for ($i = 0; $i < sizeof($userKeys); $i++) 
                    $this->_setUserKeys( $idUser, $i + 1, $userKeys[$i] );
            }

            $this->query = "UPDATE keysbank_users SET current_state = :new_state WHERE id = :id";

            $this->parametros['id']        = $idUser;
            $this->parametros['new_state'] = $newState;

            $this->get_results_from_query();
            $this->close_connection();
        }

        /**
         * Elimina un usuario cuyo ID es pasado como parámetro.
         * 
         * Esta acción provocará en la base de datos un borrado previo (trigger)
         * de todas las cuentas y keys asociados al usuario.
         * 
         * @param Number $idUser ID del usuario a eliminar
         */
        public function deleteUser( $idUser ) {
            $this->query = "DELETE FROM keysbank_users WHERE id = :id";

            $this->parametros['id']        = $idUser;

            $this->get_results_from_query();
            $this->close_connection();
        }

        /**
         * Devuelve un array con claves hexadecimales de 255 caracteres de longitud. 
         * El número de claves creadas será pasado por parámetro.
         * 
         * @param Number $nKeys Número de llaves a generar
         */
        private function _genUserKeys($nKeys) {
            $keys = array();
            for ($i = 0; $i < $nKeys; $i++) 
                array_push( $keys, $this->_genKey() );
            return $keys;
        }

        /**
         * Genera una de las llaves hexadecimal de 255 caracteres pertenecientes al usuario
         */
        private function _genKey() {
            $CHARACTERES = ['a','b','c','d','e','f','1','2','3','4','5','6','7','8','9','0'];
            $LENGTH_KEY  = 255;
            $keyGenerated = "";
            for ($i = 0; $i < $LENGTH_KEY; $i++) 
                $keyGenerated .= strtoupper( $CHARACTERES[ intval( rand(0,sizeof($CHARACTERES) - 1) ) ] );
            return $keyGenerated;
        }
        

    }
    
?>