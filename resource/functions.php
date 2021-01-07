<?php
    function loginScreenVisibility($loggedNow) {
        if ($_SESSION['user']['perfil'] == 'INVITED')
            return 'login_screen';
        return  $loggedNow ? 'login_screen logged' : 'hidden';
    }
    function closeSession() {
        session_unset();
        session_destroy();
        session_start();
        session_regenerate_id();
        header('Location:index.php');
    }
?>