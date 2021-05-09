<?php
    // ACTIONS CONTROLLER \\
    $result_search = array();

    $emptyList = FALSE;
    
    if (isset($_GET['activate'])) {         //Acción de activar o reactivar a un usuario
        $_SESSION['instance_users']->updateState( 'ACTIVE', $_GET['activate'] );
        header('Location:./users.php');
    }
    elseif (isset($_GET['ban'])) {          //Acción de banear a un usuario
        $_SESSION['instance_users']->updateState( 'BANNED', $_GET['ban'] );
        header('Location:./users.php');
    }
    elseif (isset($_POST['delete_user']))   //Borrar a un usuario (junto a todas sus cuentas y llaves)
        $_SESSION['instance_users']->deleteUser( $_POST['idUser'] );
    else {                                  //Mostrar lista de usuarios o usuario buscado
        if (isset($_POST['search_user'])) 
            $result_search = $_SESSION['instance_users']->getUsers( $_POST['input_search'] );
        else {
            $result_search = $_SESSION['instance_users']->getUsers('');
            $emptyList = !sizeof($result_search);
        }
    }
    

    //  VIEWS  \\
    if (isset($_GET['del'])) 
        include "../views/users/del.php";
    elseif (isset($_GET['deleted'])) 
        include "../views/users/deleted.php";
    else 
        include "../views/users/main.php";

?>