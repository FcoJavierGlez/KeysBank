<?php
    /* Acceso sólo para el perfil administrador */
    if ( $_SESSION['user']['perfil'] !== "ADMIN" || $_SESSION['user']['perfil'] == 'ADMIN' && strtolower($_SESSION['user']['pass']) == 'admin' )
        header('Location:../index.php');
?>