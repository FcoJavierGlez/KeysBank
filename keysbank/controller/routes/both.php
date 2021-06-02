<?php
    /* Acceso para usuarios activados y administrador */
    if ($_SESSION['user']['perfil'] == "INVITED" || $_SESSION['user']['current_state'] !== "ACTIVE") 
        header('Location:../index.php');
?>