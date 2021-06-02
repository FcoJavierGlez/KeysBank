<?php
    /**
     * @author Francisco Javier González Sabariego
     * 
     * Devuelve la lista con las plataformas correspondientes a la categoría elegida.
     */
        
    include "../config/db_config.php";
    include "../resource/functions.php";
    include "../class/DBAbstractModel.php";
    include "../class/Accounts.php";

    session_start();

    if (!isset($_POST['search'])) {
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
        $result = array( ['AES_DECRYPT(UNHEX(A.info),K.password)' => replaceCharacterByOtherCharacter( $_SESSION['instance_accounts']->getInfoAccountById($_SESSION['user']['id'], $_POST['search'])[0]['AES_DECRYPT(UNHEX(A.info),K.password)'], array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>"), array(" ","'",'"',"&","|","<",">") )] );
        print_r( json_encode( $result ) );
    }
?>