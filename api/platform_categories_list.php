<?php
    /**
     * @author Francisco Javier González Sabariego
     * 
     * Devuelve la lista con las categorías de plataformas.
     */
    header("Access-Control-Allow-Origin: *");
    
    include "../config/db_config.php";
    include "../resource/functions.php";
    include "../class/DBAbstractModel.php";
    include "../class/Platforms.php";

    $platforms = Platforms::singleton();
    $categoriesList = $platforms->getPlatformCategories();

    print_r(json_encode($categoriesList));
?>