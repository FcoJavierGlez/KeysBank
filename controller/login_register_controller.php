<?php
    //Variables de login
    $loggedNow           = FALSE;
    $errorLogin          = FALSE;
    $userPending         = FALSE;
    $userBanned          = FALSE;

    //Variables de registro
    $registered          = FALSE;
    $userExistException  = FALSE;
    $mailFormatException = FALSE;
    $mailExistException  = FALSE;
    $passCheckException  = FALSE;


    if ( isset($_POST['login']) ) {     //Login
        $usuario = $_SESSION['instance_users']->getUserByNick( dataClean($_POST['nick']) );
        if ( sizeof($usuario) && $usuario[0]['AES_DECRYPT(UNHEX(U.pass),K.password)'] == dataClean($_POST['pswd']) ) {
            if ($usuario[0]['current_state'] == 'PENDING') {
                $userPending = TRUE;
                $errorLogin = TRUE;
            }
            elseif($usuario[0]['current_state'] == 'BANNED') {
                $userBanned = TRUE;
                $errorLogin = TRUE;
            }
            else {
                $_SESSION['user']['id']                = $usuario[0]['id'];
                $_SESSION['user']['nick']              = $usuario[0]['nick'];
                $_SESSION['user']['pass']              = $usuario[0]['AES_DECRYPT(UNHEX(U.pass),K.password)'];
                $_SESSION['user']['name']              = $usuario[0]['AES_DECRYPT(UNHEX(U.name),K.password)'];
                $_SESSION['user']['surname']           = $usuario[0]['AES_DECRYPT(UNHEX(U.surname),K.password)'];
                $_SESSION['user']['email']             = $usuario[0]['email'];
                $_SESSION['user']['perfil']            = $usuario[0]['perfil'];
                $_SESSION['user']['current_state']     = $usuario[0]['current_state'];
                $_SESSION['user']['days_old_password'] = $usuario[0]['days_old_password'];
                $loggedNow = TRUE;
                if ( $_SESSION['user']['perfil'] == 'USER' ) //Si logea un usuario comprobamos si la contraseña del administrador es la contraseña por defecto
                    $_SESSION['insecure_app'] = strtolower( $_SESSION['instance_users']->getPassProfileUser(1)[0]['AES_DECRYPT(UNHEX(U.pass),K.password)'] ) == 'admin';
            }
            
        }
        else
            $errorLogin = TRUE;
    }
    elseif (isset($_POST['add_user'])) {    //Registro
        try {
            $user_data = array(
                'nick' => strtolower( dataClean($_POST['nick']) ),
                'pass' => dataClean($_POST['pswd']),
                'pass2' => dataClean($_POST['pswd2']),
                'name' => replaceCharacterByOtherCharacter( dataClean($_POST['name']), array(" ","'",'"',"&","|","<",">"), array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>") ),
                'surname' => replaceCharacterByOtherCharacter( dataClean($_POST['surname']), array(" ","'",'"',"&","|","<",">"), array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>") ),
                'email' => dataClean($_POST['email']),
            );

            //Creamos usuario
            $_SESSION['instance_users']->setUser($user_data);
            
            $registered = TRUE;
        } 
        catch (UserExistException $userExistException) {}
        catch (MailFormatException $mailFormatException) {}
        catch (MailExistException $mailExistException) {}
        catch (PassCheckException $passCheckException) {}
    }
?>