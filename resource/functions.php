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
        $tildes  = array(" ","á","é","í","ó","ú","Á","É","Í","Ó","Ú","Ñ","ñ","!");
        $letters = array("_","a","e","i","o","u","a","e","i","o","u","n","n","");
        return strtolower(str_replace( $tildes, $letters, $string ));
    }
    /**
     * Genera una clave hexadecimal de 255 caracteres
     */
    function genKey() {
        $CHARACTERES = ['a','b','c','d','e','f','1','2','3','4','5','6','7','8','9','0'];
        $LENGTH_PASS = 255;
        $keyGenerated = "";
        for ($i = 0; $i < $LENGTH_PASS; $i++) 
            $keyGenerated .= strtoupper($CHARACTERES[ intval( rand(0,sizeof($CHARACTERES) - 1) ) ]);
        return $keyGenerated;
    }

    /**
     * Reemplaza todos los caracteres de un String por el caracter
     * pasado como parámetro.
     */
    function replaceByCharacter($string,$character) {
        $stringReturned = "";
        for ($i = 0; $i < strlen($string); $i++) 
            $stringReturned .= $character;
        return $stringReturned;
    }

    /**
     * Devuelve un array con claves hexadecimales de 255 caracteres de longitud. 
     * El número de claves creadas será pasado por parámetro.
     */
    function genUserKeys($nKeys) {
        $keys = array();
        for ($i = 0; $i < $nKeys; $i++) 
            array_push($keys,genKey());
        return $keys;
    }

    /**
     * Renderiza la lista de cuentas del usuario (o la búsqueda realizada en la misma)
     */
    function renderUserAccountList($list) {
        foreach ($list as $value) {
            echo "<a href='".$_SERVER['PHP_SELF']."?view=".$value['id'].""."'>";
                echo "<article>";
                    echo "<div class='plataform'>";
                        echo "<img src='../img/plataform/".normalizeString($value['name_plataform']).".png' alt='Logo Twitter'>";
                        echo "<h3>".$value['name_plataform'].":</h3>";
                    echo "</div>";
                    echo "<div class='basic-info'>";
                        echo "<div><b><u>Account</u>:</b></div>";
                        echo "<div><span>".$value['AES_DECRYPT(UNHEX(A.name_account),K.password)']."</span></div>";
                    echo "</div>";
                echo "</article>";
            echo "</a>";
        }
    }
?>