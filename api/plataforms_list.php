<?php
    header("Access-Control-Allow-Origin: *");
    
    include "../config/config_dev.php";
    include "../resource/functions.php";
    include "../class/DBAbstractModel.php";
    include "../class/Plataforms.php";

    $plataforms = Plataforms::singleton();
    $plataformsList = $plataforms->getPlataforms();

    /* echo "<pre>";
        print_r($plataformsList);
    echo "</pre>"; */
    print_r(json_encode($plataformsList));
?>