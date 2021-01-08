<?php
    /**
     * 
     */
    function loginScreenVisibility($loggedNow) {
        if ($_SESSION['user']['perfil'] == 'INVITED')
            return 'login_screen';
        return  $loggedNow ? 'login_screen logged' : 'hidden';
    }

    /**
     * 
     */
    function inputStyle($error,$loggedNow) {
        if ($error)
            return 'error';
        return  $loggedNow ? 'input_logged' : '';
    }

    /* function getInputLogin($errorLogin,$loggedNow) {
        if ($errorLogin) 
            return "<input type='text' name='username' placeholder='username' class='error'><input type='password' name='pswd' placeholder='password' class='error'>";
        return $loggedNow ? 
            "<input type='text' name='username' placeholder='username' class='input_logged'><input type='password' name='pswd' placeholder='password' class='input_logged'>" :
            "<input type='text' name='username' placeholder='username' class=''><input type='password' name='pswd' placeholder='password' class=''>";
    } */

    /**
     * 
     */
    function closeSession() {
        session_unset();
        session_destroy();
        session_start();
        session_regenerate_id();
        header('Location:index.php');
    }

    /**
     * Limpia los datos de entrada eliminando espacios en blanco o caracteres que no sean letras.
     */
    function dataClean($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /**
     * Elimina tildes y eñes de la cadena insertada
     */
    function normalizeString( $string ) {
        $tildes  = array("á","é","í","ó","ú","Á","É","Í","Ó","Ú","Ñ","ñ");
        $letters = array("a","e","i","o","u","a","e","i","o","u","n","n");
        return strtolower(str_replace( $tildes, $letters, $string ));
    }
?>