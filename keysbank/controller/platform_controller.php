<?php
    // ACTIONS CONTROLLER \\
    $categories      = array();
    $subcategories   = array();
    $platform_data   = array();
    $search_platform = array();
    $search_category = array();

    $logo = '';
    
    $emptyList        = FALSE;
    $existPlatform    = FALSE;
    $successfulAction = FALSE;
    $actionFailed     = FALSE;
    $existSubcategory = FALSE;
    
    if (isset($_POST['add_platform'])) {
        $platform_data = array(
            'idCategory' => $_POST['categories'],
            'idSubcategory' => $_POST['subcategories'],
            'name' => replaceCharacterByOtherCharacter( dataClean($_POST['name']), ['&amp;'], ['&'] )
        );

        $existPlatform = sizeof( $_SESSION['instance_platforms']->getPlatformByName( dataClean($_POST['name']) ) );
        
        if ( !$existPlatform ) {    //Si el nombre de la plataforma no estaba ya registrado procedemos a añadir

            $existSubcategory = $_SESSION['instance_platforms']->validateSubcategory( $platform_data['idCategory'],$platform_data['idSubcategory'] );

            if ( $existSubcategory ) { //Validamos la existencia de la subcategoría elegida dentro de la categoría especificada
                //Si no existe el logo se agrega
                if ($_FILES['logo']['error'] == 0) 
                    if (!file_exists("../img/platform/".normalizeString($platform_data['name']).".png")) 
                        move_uploaded_file($_FILES["logo"]["tmp_name"],"../img/platform/".normalizeString( $platform_data['name'] ).".png");
    
                //inserción de datos en la BBDD
                $_SESSION['instance_platforms']->setPlatform( $platform_data );
                
                $successfulAction = TRUE;
            } 
            else 
                $actionFailed = TRUE;
        }
    }
    elseif (isset($_GET['edit'])) { //Vista editar plataforma
        $search_platform = $_SESSION['instance_platforms']->getPlatformById( $_GET['edit'] );

        if (!sizeof($search_platform)) header('Location:./platforms.php');  //Si no existe la plataforma redirigimos a la vista main

        //Obtenemos la lista de subcategorías para la categoría de la plataforma
        $subcategories = $_SESSION['instance_platforms']->getSubcategoriesList( $_SESSION['instance_platforms']->getCategoryIdByName( $search_platform[0]['category'] ) );
        
        //Cargamos el nombre del logo de la plataforma (si no existe usamos el logo por defecto 'other.png')
        $logo = file_exists("../img/platform/".normalizeString($search_platform[0]['name']).".png") ? 
                normalizeString($search_platform[0]['name']).".png" :
                "other.png";
    }
    elseif (isset($_POST['edit_platform'])) {   //Acción editar plataforma
        $search_platform  = $_SESSION['instance_platforms']->getPlatformById( $_POST['id'] );
        $categories       = $_SESSION['instance_platforms']->getCategoryIdByName( $search_platform[0]['category'] );
        $existSubcategory = $_SESSION['instance_platforms']->validateSubcategory( $categories, $_POST['subcategories'] );
        
        $existPlatform = sizeof( $_SESSION['instance_platforms']->getPlatformByName( dataClean($_POST['name']) ) );

        if ( $existSubcategory ) { //Validamos la existencia de la subcategoría elegida dentro de la categoría especificada
            $platform_data = array(
                'id' => $_POST['id'],
                'idSubcategory' => $_POST['subcategories'],
                'name' => replaceCharacterByOtherCharacter( dataClean($_POST['name']), ['&amp;'], ['&'] )
            );

            if ( $search_platform[0]['name'] == dataClean($_POST['name']) ) { //Si el nombre no cambia en la actualización    
                if ($_FILES['logo']['error'] == 0) {    //Si se sube fichero
                    if (!file_exists("../img/platform/".normalizeString($platform_data['name']).".png")) //Si no existe el logo se agrega
                        move_uploaded_file($_FILES["logo"]["tmp_name"],"../img/platform/".normalizeString( $platform_data['name'] ).".png");
                    else {  //Si existe se borra el viejo y se añade el nuevo
                        unlink( "../img/platform/".normalizeString( $search_platform[0]['name'] ).".png" );
                        move_uploaded_file($_FILES["logo"]["tmp_name"],"../img/platform/".normalizeString( $platform_data['name'] ).".png");
                    }
                }
            } 
            else {  //Si cambia el nombre de la plataforma
                if (!$existPlatform) { //Si el nombre de la plataforma no estaba ya registrado procedemos a actualizar
                    if ($_FILES['logo']['error'] == 0) {    //Si se sube fichero
                        if (!file_exists("../img/platform/".normalizeString( $search_platform[0]['name'] ).".png")) //Si no existe el logo se agrega
                            move_uploaded_file($_FILES["logo"]["tmp_name"],"../img/platform/".normalizeString( $platform_data['name'] ).".png");
                        else {  //Si existe se renombra con el nuevo nombre de la plataforma
                            unlink( "../img/platform/".normalizeString( $search_platform[0]['name'] ).".png" );
                            move_uploaded_file($_FILES["logo"]["tmp_name"],"../img/platform/".normalizeString( $platform_data['name'] ).".png");
                        } 
                    }
                    else {  //Si no se ha subido un nuevo logo se renombra con el nuevo nombre de la plataforma
                        rename("../img/platform/".normalizeString( $search_platform[0]['name'] ).".png","../img/platform/".normalizeString( $platform_data['name'] ).".png");
                    }
                }
            }
            //Actualizar BBDD
            $_SESSION['instance_platforms']->updatePlatform( $platform_data );
            $successfulAction = TRUE;
        } else //Si la subcategoría no es válida
            $actionFailed = TRUE;
    }
    elseif (isset($_POST['delete_platform'])) {     //Acción de borrar la plataforma
        $search_platform = $_SESSION['instance_platforms']->getPlatformById( $_POST['idPlatform'] );

        if (!sizeof($search_platform)) header('Location:./platforms.php'); //Si no existe la plataforma redirigimos a la vista main

        //Si la plataforma no es 'Other' procedemos a borrarla (Other es el nombre de la plataforma por defecto para cada subcategoría)
        if (normalizeString($search_platform[0]['name']) !== 'other') {
            //si existe el logo y no es other.png se borra (other.png es el LOGO POR DEFECTO pese a que existen plataformas con ese nombre)
            if (file_exists("../img/platform/".normalizeString($search_platform[0]['name']).".png") && normalizeString($search_platform[0]['name']) !== 'other') 
                unlink( "../img/platform/".normalizeString( $search_platform[0]['name'] ).".png" );
            
            //Se borra la plataforma de la BBDD (y todas las cuentas registradas en esta plataforma)
            $_SESSION['instance_platforms']->deletePlatform( $search_platform[0]['id'] );
        }
    }
    else {                                  //Mostrar lista de plataformas o plataforma buscada
        $categories    = $_SESSION['instance_platforms']->getPlatformCategories();
        if (isset($_POST['search_platform'])) 
            $result_search = $_SESSION['instance_platforms']->getPlatformBySimilarName( $_POST['input_search'] );
        else 
            $result_search = $_SESSION['instance_platforms']->getPlatformsList();
        $emptyList = !sizeof($result_search);
    }
    

    //  VIEWS  \\
    if (isset($_GET['add'])) 
        include "../views/platforms/add.php";
    elseif (isset($_GET['edit'])) 
        include "../views/platforms/edit.php";
    elseif (isset($_GET['edited'])) 
        include "../views/platforms/edited.php";
    elseif (isset($_GET['del'])) 
        include "../views/platforms/del.php";
    elseif (isset($_GET['deleted'])) 
        include "../views/platforms/deleted.php";
    else 
        include "../views/platforms/main.php";

?>