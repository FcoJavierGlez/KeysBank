<?php
    /* 
    Acceso solo para usuarios activados. 

    $_SESSION['insecure_app']: Si la contraseña del admin es la contraseña por defecto estamos ante un fallo de seguridad 
    y, por tanto, evitamos también el acceso a los usuarios denegando el uso de la app a todo el mundo
    */
    if ( $_SESSION['user']['perfil'] !== "USER" || $_SESSION['user']['current_state'] !== "ACTIVE" || $_SESSION['insecure_app'] ) 
        header('Location:../index.php');
?>