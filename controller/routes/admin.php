<?php
    /* Acceso sólo para el perfil administrador */
    if ($_SESSION['user']['perfil'] !== "ADMIN")
        header('Location:../index.php');
?>