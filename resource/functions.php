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
     * 
     * Ejemplo: ("frase de ejemplo", "*") -> "****************"
     */
    function replaceByCharacter($string,$character) {
        $stringReturned = "";
        for ($i = 0; $i < strlen($string); $i++) 
            $stringReturned .= $character;
        return $stringReturned;
    }

    /**
     * Reemplaza todos los caracteres especificados de un String por el caracter
     * pasado como parámetro. 
     * 
     * Ejemplo: ("frase de ejemplo", " ", "\\s") -> "frase\sde\sejemplo";
     */
    function replaceCharacterByOtherCharacter($string,$characterToReplace,$otherCharacter) {
        $replaceThis = array($characterToReplace);
        $replaceBy   = array($otherCharacter);
        return strtolower(str_replace( $replaceThis, $replaceBy, $string ));
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
            $route = file_exists("../img/platform/".normalizeString($value['name_platform']).".png") ? "../img/platform/".normalizeString($value['name_platform']).".png" : "../img/platform/other.png";
            echo "<a href='".$_SERVER['PHP_SELF']."?view=".$value['id'].""."'>";
                echo "<article class='card'>";
                    echo "<div class='platform'>";
                        echo "<img src='".$route."' alt='Logo ".$value['name_platform']."'>";
                        echo "<h3>".$value['name_platform'].":</h3>";
                    echo "</div>";
                    echo "<div class='basic-info info-card'>";
                        /* echo "<pre>";
                            print_r($list);
                        echo "</pre>"; */
                        echo "<div><b><u>Account</u>:</b></div>";
                        echo "<div><span>".$value['AES_DECRYPT(UNHEX(A.name_account),K.password)']."</span></div>";
                        echo "<div><b><u>Notes</u>:</b></div>";
                        echo "<div><textarea class=".($value['AES_DECRYPT(UNHEX(A.notes),K.password)'] == '' ? 'text-center' : 'bold')." disabled>".($value['AES_DECRYPT(UNHEX(A.notes),K.password)'] == "" ? 'Not available' : $value['AES_DECRYPT(UNHEX(A.notes),K.password)'])."</textarea></div>";
                    echo "</div>";
                echo "</article>";
            echo "</a>";
        }
    }

    /**
     * Renderiza
     */
    function renderPlatformList ($platformList,$platformAccount) {
        $subcategory = "";
        echo "<select name='subcategories' id='subcategories'>";
        echo "<option value=''>-- Choice an option --</option>";
        foreach ($platformList as $array) {
            if ($subcategory !== $array['subcategory']) {
                $subcategory = $array['subcategory'];
                echo "<optgroup label='".$subcategory."'>";
                foreach($platformList as $platform) {
                    if ($platform['subcategory'] == $subcategory) {
                        echo "<option value='".$platform['name']."' ".($platformAccount == $platform['name'] ? 'selected' : '').">".$platform['name']."</option>";
                    }
                }
                echo "</optgroup>";
            }
        }
        echo "</select>";
    }

    /**
     * Valida que la plataforma seleccionada al editar / agregar una cuenta es correcta.
     * 
     * @param Array $platformNameList  Array con los nombres de las plataformas para la categoría elegida
     * @param String $platformSelected Nombre de la plataforma elegida
     * 
     * @return Boolean TRUE si es correcta, FALSE si no lo es
     */
    function validatePlatformSelected($platformNameList,$platformSelected) {
        for ($i = 0; $i < sizeof($platformNameList); $i++) 
            if ($platformNameList[$i]['name'] == $platformSelected) return TRUE;
        return FALSE;
    }
    
?>