<?php
    // ACTIONS CONTROLLER \\
    $categories      = array();
    $platform_data   = array();
    $search_platform = array();
    
    $emptyList           = FALSE;
    $existPlatform       = FALSE;
    $actionSuccessfully  = FALSE;
    /* $new_data_edit         = FALSE;
    $edited_successfully   = FALSE; */

    /* $mailFormatException   = FALSE;
    $mailExistException    = FALSE;

    $passCheckException    = FALSE;
    $checkOldPassException = FALSE; */
    
    if (isset($_POST['add_platform'])) {
        $platform_data = array(
            'idCategory' => $_POST['categories'],
            'idSubcategory' => $_POST['subcategories'],
            'name' => dataClean($_POST['name'])
        );

        $existPlatform = sizeof( $_SESSION['instance_platforms']->getPlatformByName( dataClean($_POST['name']) ) );
        
        if ( !$existPlatform ) {    //Si el nombre de la plataforma no estaba ya registrado procedemos a añadir
            //Si no existe el logo se agrega
            if ($_FILES['logo']['error'] == 0) 
                if (!file_exists("../img/platform/".normalizeString($platform_data['name']).".png")) 
                    move_uploaded_file($_FILES["logo"]["tmp_name"],"../img/platform/".normalizeString( $platform_data['name'] ).".png");

            //inserción de datos en la BBDD
            $_SESSION['instance_platforms']->setPlatform( $platform_data );
            
            $actionSuccessfully = TRUE;
        }
    }
    elseif (isset($_POST['edit_platform'])) {
        
        
    }
    elseif (isset($_POST['delete_platform'])) {
        $search_platform = $_SESSION['instance_platforms']->getPlatformById( $_POST['idPlatform'] );

        //Si la plataforma no es 'Other' procedemos a borrarla (Other es el nombre de plataforma por defecto de cada subcategoría)
        if (normalizeString($search_platform[0]['name']) !== 'other') {
            //si existe el logo y no es other.png se borra (other.png es el LOGO POR DEFECTO pese a que existen plataformas con ese nombre)
            if (file_exists("../img/platform/".normalizeString($search_platform[0]['name']).".png") && normalizeString($search_platform[0]['name']) !== 'other') 
                unlink( "../img/platform/".normalizeString( $search_platform[0]['name'] ).".png" );
            
            //Se borra la plataforma de la BBDD (y todas las cuentas registradas en esta plataforma)
            $_SESSION['instance_platforms']->deletePlatform( $search_platform[0]['id'] );
        }

        
    }
    else {                                  //Mostrar lista de plataformas o plataforma buscada
        if (isset($_POST['search_platform'])) {
            $categories    = $_SESSION['instance_platforms']->getPlatformCategories();
            $result_search = $_SESSION['instance_platforms']->getPlatformBySimilarName( $_POST['input_search'] );
            $emptyList = !sizeof($result_search);
        }
        else {
            $categories    = $_SESSION['instance_platforms']->getPlatformCategories();
            $result_search = $_SESSION['instance_platforms']->getPlatformsList();
            $emptyList = !sizeof($result_search);
        }
    }
    

    //  VIEWS  \\
    if (isset($_GET['add'])) 
        include "../views/platforms/add.php";
    elseif (isset($_GET['edit'])) 
        include "../views/platforms/edit.php";
    elseif (isset($_GET['del'])) 
        include "../views/platforms/del.php";
    elseif (isset($_GET['deleted'])) 
        include "../views/platforms/deleted.php";
    else 
        include "../views/platforms/main.php";

?>