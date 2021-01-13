<?php
    /**
     * @author Francisco Javier González Sabariego
     * 
     * Devuelve la lista con las subcategorías de la categoría elegida.
     */
    header("Access-Control-Allow-Origin: *");
        
    include "../config/config_dev.php";
    include "../resource/functions.php";
    include "../class/DBAbstractModel.php";
    include "../class/Platforms.php";

    $platforms = Platforms::singleton();
    $subcategoriesList = $platforms->getSubcategoriesList($_POST['categories']);

    print_r(json_encode($subcategoriesList));
?>