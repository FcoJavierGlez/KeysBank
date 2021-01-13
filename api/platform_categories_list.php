<?php
    /**
     * @author Francisco Javier González Sabariego
     * 
     * Devuelve la lista con las categorías de plataformas.
     */
    header("Access-Control-Allow-Origin: *");
    
    include "../config/config_dev.php";
    include "../resource/functions.php";
    include "../class/DBAbstractModel.php";
    include "../class/Plataforms.php";

    $plataforms = Plataforms::singleton();
    $categoriesList = $plataforms->getPlataformCategories();

    print_r(json_encode($categoriesList));
?>