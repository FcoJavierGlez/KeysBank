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
    include "../class/Plataforms.php";

    $plataforms = Plataforms::singleton();
    $subcategoriesList = $plataforms->getSubcategoriesList($_POST['categories']);

    print_r(json_encode($subcategoriesList));

    /* $plataformSelected = $_POST['plataforms'];

    echo json_encode($plataformSelected); */
?>