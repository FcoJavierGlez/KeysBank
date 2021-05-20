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
        $tildes  = array(" ","á","é","í","ó","ú","Á","É","Í","Ó","Ú","Ñ","ñ","!","&");
        $letters = array("_","a","e","i","o","u","a","e","i","o","u","n","n","","_and_");
        return strtolower(str_replace( $tildes, $letters, $string ));
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
     * 
     * @param Array $characterToReplace Array con los caracteres que van a ser sustituidos
     * @param Array $otherCharacter Array con los caracteres que van a sustituir
     * 
     * @return String Cadena con los caracteres sustituídos
     */
    function replaceCharacterByOtherCharacter($string,$characterToReplace,$otherCharacter) {
        return str_replace( $characterToReplace, $otherCharacter, $string );
    }

    /**
     * Filtra la lista de cuentas del usuario por categorías
     * según el id de la categoría.
     * 
     * @param
     * @param
     * @return
     */
    function filterAccountsIdCategory($arrayAccounts,$id) {
        $array = array();
        foreach ($arrayAccounts as $value) {
            if ($id == $value['idCategory']) 
                array_push($array,$value);
        }
        return $array;
    }

    /**
     * 
     */
    function filterPlatformsByCategory($arrayPlatformList,$category) {
        $array = array();
        foreach ($arrayPlatformList as $value) {
            if ($category == $value['category']) 
                array_push($array,$value);
        }
        return $array;
    }

    /**
     * Renderiza varias tablas, una por cada categoría, 
     * con las plataformas pertenecientes a dicha categoría
     * 
     * @param Array $categories    Conjunto de categorías almacenada en la BBDD
     * @param Array $result_search Resultado de la búsqueda de plataformas
     */
    function renderTablePlatformList($categories, $result_search) {
        $platformList = array();
        for ($i = 0; $i < sizeof($categories); $i++) { 
            //filtramos las plataformas por categoría para crear una tabla para cada categoría
            $platformList = filterPlatformsByCategory($result_search,$categories[$i]['category']);
            
            if (!sizeof($platformList)) continue;
            echo "<div class='category'><hr/>".replaceCharacterByOtherCharacter($platformList[0]['category'],array("_"),array(" "))."<hr/></div>";
            echo "<table class='table-platform-list'>";
                echo "<tr><th>SUBCATEGORY</th><th>PLATFORM</th><th>EDIT</th><th>DELETE</th></tr>";
                renderTableRowsPlatform($platformList);
            echo "</table>";
        }
    }

    /**
     * Renderiza las filas, con las plataformas pasadas por parámetro, 
     * perteneciente a la tabla de la función renderTablePlatformList
     * 
     * @param Array $platformList Lista de plataformas de una categoría
     */
    function renderTableRowsPlatform ($platformList) {
        $route = '';
        for ($i = 0; $i < sizeof($platformList); $i++) {
            $route = file_exists("../img/platform/".normalizeString($platformList[$i]['name']).".png") ? "../img/platform/".normalizeString($platformList[$i]['name']).".png" : "../img/platform/other.png";
            echo "<tr>";
                echo "<td>".$platformList[$i]['subcategory']."</td>";
                echo "<td class='img-align-center'><img src='$route'>".$platformList[$i]['name']."</td>";
                echo "<td><a href=".$_SERVER['PHP_SELF'].'?edit='.$platformList[$i]['id']."><button class='back'>Edit</button></a></td>";
                echo "<td><a href=".$_SERVER['PHP_SELF'].'?del='.$platformList[$i]['id']."><button class='cancel'>Delete</button></a></td>";
            echo "</tr>";
        }

    }

    /**
     * Renderiza la lista de usuarios (tabla)
     */
    function renderUserList( $userList ) {
        echo "<table>";
            echo "<th>NICK</th><th>EMAIL</th><th>PROFILE</th><th>STATE</th><th>UPDATE</th><th>DELETE</th>";
                foreach ($userList as $user) {
                    echo "<tr>";
                        echo "<td>".$user['nick']."</td>";      //NICK
                        echo "<td>".$user['email']."</td>";     //EMAIL
                        echo "<td>".$user['perfil']."</td>";    //PROFILE
                        //STATE
                        echo "<td class='".strtolower($user['current_state'])."'>".$user['current_state']."</td>";
                        if ( $user['perfil'] == "USER" ) {
                            echo ( ( ( $user['current_state'] == "PENDING" || $user['current_state'] == "BANNED" ) ) ? 
                                "<td><a href=".$_SERVER['PHP_SELF']."?activate=".$user['id']."><button class='accept'>ACTIVATE</button></a></td>" : 
                                "<td><a href=".$_SERVER['PHP_SELF']."?ban=".$user['id']."><button class='cancel'>BAN</button></a></td>" );
                            echo ( $user['current_state'] !== "ACTIVE" ? 
                                "<td><a href=".$_SERVER['PHP_SELF']."?del=".$user['id']."><button class='delete_user'>DELETE</button></a></td>" :
                                "<td>---</td>" );
                        }
                        else {
                            echo "<td></td>";
                            echo "<td></td>";
                        }
                    echo "</tr>";
                }
            echo "</table>";
    }

    /**
     * Renderiza la lista de cuentas del usuario dividiéndolas por categorías
     */
    function renderUserAccountList($list) {
        $accountsListByCategory = array();
        for ($i = 0; $i < 7; $i++) { 
            $accountsListByCategory = filterAccountsIdCategory($list,$i);
            if (!sizeof($accountsListByCategory)) continue;
            echo "<div class='category'><hr/>".replaceCharacterByOtherCharacter($accountsListByCategory[0]['category'],array("_"),array(" "))."<hr/></div>";
            echo "<div class='cards-view'>";
            renderAccountsList($accountsListByCategory);
            echo "</div>";
        }
    }

    /**
     * Renderiza la lista de cuentas de una categoría específica
     */
    function renderAccountsList($list) {
        foreach ($list as $value) {
            $route = file_exists("../img/platform/".normalizeString($value['name_platform']).".png") ? "../img/platform/".normalizeString($value['name_platform']).".png" : "../img/platform/other.png";
            echo "<a href='".$_SERVER['PHP_SELF']."?view=".$value['id'].""."'>";
                echo "<article class='card'>";
                    echo "<div class='platform'>";
                        echo "<img src='".$route."' alt='Logo ".$value['name_platform']."'>";
                        echo "<h3>".$value['name_platform'].":</h3>";
                    echo "</div>";
                    echo "<div class='basic-info info-card'>";
                        echo "<div><b><u>Account</u>:</b></div>";
                        echo "<div><span class='word-break'>".$value['AES_DECRYPT(UNHEX(A.name_account),K.password)']."</span></div>";
                        echo "<div><b><u>Notes</u>:</b></div>";
                        echo "<div><textarea class=".($value['AES_DECRYPT(UNHEX(A.notes),K.password)'] == '' ? 'text-center' : 'bold')." disabled>".($value['AES_DECRYPT(UNHEX(A.notes),K.password)'] == "" ? 'Not available' : replaceCharacterByOtherCharacter( $value['AES_DECRYPT(UNHEX(A.notes),K.password)'], array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>"), array(" ","'",'"',"&","|","<",">") ) )."</textarea></div>";
                        echo "<div class='alert'>".($value['DATEDIFF(CURDATE(), A.pass_date)'] >= $_SESSION['user']['days_old_password'] ? "PASSWORD TOO OLD" : "")."</div>";
                    echo "</div>";
                echo "</article>";
            echo "</a>";
        }
    }


    /**
     * Renderiza la lista de opciones del selector de plataformas seleccionando la plataforma a la que pertenece
     * la cuenta que se está mostrando en la vista 'edit' de la página 'accounts'
     * 
     * @param Array $platformList    La lista de plataformas de una categoría
     * @param Array $platformAccount La plataforma a la que pertenece la cuenta
     */
    function renderPlatformSelect ($platformList,$platformAccount) {
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
     * Renderiza la lista de opciones del selector de subcategorías seleccionando la subcategoría a la que pertenece
     * la plataforma que se está mostrando en la vista 'edit' de la página 'platforms'
     * 
     * @param Array $subcategoryList     La lista de subcategorías de una categoría
     * @param Array $subcategoryPlatform La subcategoría a la que pertenece la plataforma
     */
    function renderSubcategorySelect ($subcategoryList,$subcategoryPlatform) {
        echo "<select name='subcategories' id='subcategories'>";
        echo "<option value=''>-- Choice an option --</option>";
        foreach ($subcategoryList as $array) {
            /* echo $array['id']."<br>";
            echo $array['subcategory']."<br>";
            echo $subcategoryPlatform."<br>"; */
            echo "<option value='".$array['id']."' ".($subcategoryPlatform == $array['subcategory'] ? 'selected' : '').">".$array['subcategory']."</option>";
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