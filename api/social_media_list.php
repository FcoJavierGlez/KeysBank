<?php
    header("Access-Control-Allow-Origin: *");
    
    include "../config/config_dev.php";
    include "../resource/functions.php";
    include "../class/DBAbstractModel.php";
    include "../class/Plataforms.php";

    $plataforms = Plataforms::singleton();
    $subcategoriesList = $plataforms->getSubcategoriesList(1);
    
    print_r(json_encode($subcategoriesList));
?>