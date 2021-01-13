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
    include "../class/Accounts.php";

    $account = Accounts::singleton();
    $pass = $account->getPassAccountById($_POST['us'],$_POST['ac']);

    print_r(json_encode($pass));
?>