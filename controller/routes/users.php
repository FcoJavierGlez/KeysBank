<?php
    /* Acceso solo para usuarios activados */
    if ($_SESSION['user']['perfil'] !== "USER" || $_SESSION['user']['current_state'] !== "ACTIVE") 
        header('Location:../index.php');
?>