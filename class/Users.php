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
         * Devuelve todos los usuarios de la tabla usuarios
         */
        /* public function getAllUsers () {
            $this->query = "SELECT * FROM sevi_usuarios";

            $this->get_results_from_query();
            $this->close_connection();
            
            return $this->rows;
        } */

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
                $this->parametros['keypass']       = $user_data['keypass'];

                $this->get_results_from_query();
                $this->close_connection();
            }
        }

        /**
         * Inserta las llaves del usuario par alas distintas plataformas
         */
        public function setUserKeys( $idUser,$idCategory,$keypass ) {
            $this->query = "INSERT INTO keysbank_keys (keysbank_keys.idUser, keysbank_keys.idCategory, keysbank_keys.password) 
                                VALUES (:idUser, :idCategory, :keypass)";

            $this->parametros['idUser']      = $idUser;
            $this->parametros['idCategory'] = $idCategory;
            $this->parametros['keypass']     = $keypass;

            $this->get_results_from_query();
            $this->close_connection();
        }

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
         */
        /* public function editEstado ( $user_data = array() ) {
            $this->query = "UPDATE sevi_usuarios SET estado = :estado, directorio = :directorio WHERE id = :id";

            $this->parametros['estado'] = $user_data['estado'];
            $this->parametros['directorio'] = $user_data['directorio'];
            $this->parametros['id'] = $user_data['id'];

            $this->get_results_from_query();
            $this->close_connection();
        } */
        
        /**
         * Activa el perfil del usuario:
         * 
         * -Se genera una carpeta con un nombre único para el usuario
         * -Actualiza el perfil del usuario (estado = "activo" | nombre de su directorio)
         */
        /* public function activarPerfil( $id ) {
            //Generar nombre único para carpeta
            $usuario = $this->getUserById( $id )[0];
            $nombreDirectorio = $this->getDirectoryNameUser( $usuario['nombre'], $usuario['apellidos'] );
            
            if ( !file_exists("users/".$nombreDirectorio) )     //crear carpeta con permisos
                mkdir("users/".$nombreDirectorio,0777,true);
            
            //actualizamos perfil a activo y guardarmos el nombre de la carpeta generada
            $user_data = array(
                'id' => $id,
                'estado' => "activo",
                'directorio' => $nombreDirectorio
            );
            $this->editEstado( $user_data );
        } */
    }
    
?>