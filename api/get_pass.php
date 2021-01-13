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

    preg_match('/^\?(\d+)\!(\d+)$/', $_POST['search'], $matches);

    if (sizeof($matches)) {
        $pass = $account->getPassAccountById($matches[1],$matches[2]);

        print_r(json_encode($pass));
    }
    else
        print_r(json_encode(array('AES_DECRYPT(UNHEX(A.name_account),K.password)' => 'Error 404. Not found.')));


    
?>