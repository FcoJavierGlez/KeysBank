<?php
    // ACTIONS CONTROLLER \\
    $user_data             = array();

    $new_data_edit         = FALSE;
    $edited_successfully   = FALSE;

    $userExistException    = FALSE;
    $mailFormatException   = FALSE;
    $mailExistException    = FALSE;

    $passCheckException    = FALSE;
    $checkOldPassException = FALSE;
    
    if (isset($_POST['update_profile'])) {
        $new_data_edit = TRUE;
        
        $user_data = array(
            'id' => $_SESSION['user']['id'],
            'nick' => $_POST['nick'],
            'name' => replaceCharacterByOtherCharacter( dataClean($_POST['name']), array(" ","'",'"',"&","|","<",">"), array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>") ),
            'surname' => replaceCharacterByOtherCharacter( dataClean($_POST['surname']), array(" ","'",'"',"&","|","<",">"), array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>") ),
            'email' => $_POST['email'],
            'days_old_password' => $_POST['days_old_password'],
        );

        try {
            $_SESSION['instance_users']->editUser( $user_data );

            $_SESSION['user']['nick'] = $_POST['nick'];
            $_SESSION['user']['name'] = $_POST['name'];
            $_SESSION['user']['surname'] = $_POST['surname'];
            $_SESSION['user']['email'] = $_POST['email'];
            $_SESSION['user']['days_old_password'] = $_POST['days_old_password'];

            $edited_successfully = TRUE;
        } 
        catch (UserExistException $userExistException) {}  //Excepción de nick ya registrado
        catch (MailFormatException $mailFormatException) {} //Excepción de formato de correo inválido
        catch (MailExistException $mailExistException) {}  //Excepción de correo ya registrado
    }
    elseif (isset($_POST['update_password'])) {
        $new_data_edit = TRUE;

        $user_data = array(
            'id' => $_SESSION['user']['id'],
            'nick' => $_SESSION['user']['nick'],
            'old_pass' => $_POST['old_pass'],
            'new_pass' => $_POST['new_pass'],
            'new_pass2' => $_POST['new_pass2'],
        );

        try {
            $_SESSION['instance_users']->editPass( $user_data );

            $_SESSION['user']['pass'] = $_POST['new_pass'];

            $edited_successfully = TRUE;
        } 
        catch (CheckOldPassException $checkOldPassException) {} //Contraseña actual incorrecta
        catch (PassCheckException $passCheckException) {}  //Comprobación de contraseña nueva y repetición incorrectas
    }
    

    //  VIEWS  \\
    if (isset($_GET['edit'])) 
        include "../views/profile/edit.php";
    elseif (isset($_GET['edit_password'])) 
        include "../views/profile/edit_password.php";
    else 
        include "../views/profile/main.php";

?>