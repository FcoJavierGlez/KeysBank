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

    session_start();

    if (!isset($_POST['name'])) {
        echo "<h1 style='margin: 21.44px 0'>¡Objeto no localizado!</h1>";
        echo "<p style='margin: 16px 0 16px 48px'>No se ha localizado la URL solicitada en este servidor. 
            Si usted ha introducido la URL manualmente, por favor revise su ortografía e inténtelo de nuevo.</p>";
        echo "<p style='margin: 16px 0 16px 48px'>Si usted cree que esto es un error del servidor, por favor comuníqueselo al
            <a href='mailto:postmaster@localhost'>administrador del portal</a></p>";
        echo "<h2>Error 404</h2>";
        echo "<address style='margin: 16px 0 16px 48px'>
                <a href='/'>localhost</a><br>
                <span style='font-size: smaller'>Apache/2.4.41 (Win64) OpenSSL/1.1.1c PHP/7.4.1</span>
            </address>";
    } else {
        $search = $_SESSION['instance_accounts']->getAccountsUserByNameRepeat($_SESSION['user']['id'],$_POST['name']);
        echo json_encode($search);
    }


?>