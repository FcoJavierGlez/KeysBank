<?php
    /**
     * @author Francisco Javier González Sabariego
     * 
     * Devuelve la lista con las plataformas correspondientes a la categoría elegida.
     */
    header("Access-Control-Allow-Origin: *");
        
    include "../config/config_dev.php";
    include "../resource/functions.php";
    include "../class/DBAbstractModel.php";
    include "../class/Plataforms.php";

    $plataforms = Plataforms::singleton();
    $plataformsList = $plataforms->getPlataformsByCategory($_POST['categories']);

    print_r(json_encode($plataformsList));
?>