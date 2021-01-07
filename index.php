<?php
    /**
     * @author Francisco Javier González Sabariego
     */

    include "config/config_dev.php";
    /* include "resource/funciones.php"; */
    include "class/DBAbstractModel.php";
    /* include "class/Usuario.php";
    include "class/Clave.php";
    include "class/Documento.php";
    include "class/error/UserExistException.php";
    include "class/error/PassCheckException.php";
    include "class/error/CheckOldPassException.php";
    include "class/error/MailInvalidException.php";
    include "class/error/MailExistException.php";
    include "class/error/TimeLimitException.php";
    require "phpmailer/class.phpmailer.php"; */

    session_start();

    $logged = FALSE;

    if ( !isset($_SESSION['user']) ) { 
        $_SESSION['usuario']          = Usuario::singleton();
        $_SESSION['clave']            = Clave::singleton();
        $_SESSION['documento']        = Documento::singleton();

        $_SESSION['mailer']           = NULL;

        $_SESSION['user']             = array( 'perfil' => "invitado" );
    }

    if ( isset($_POST['login']) ) {
        /* $usuario = $_SESSION['usuario']->getUserByNick( limpiarDatos($_POST['user']) );
        if ( sizeof($usuario) && $usuario[0]['pass'] == limpiarDatos($_POST['pswd']) ) {
            $_SESSION['user'] = $usuario[0];
            $logged = TRUE;
        } */
    }

    if ( isset($_POST['cerrar']) ) {
        cerrarSesion();
    }

    /* include "include/procesa.php"; */

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Francisco Javier González Sabariego">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="favicon.ico">
        <script src="js/main.js"></script>
        <title>KeysBank</title>
    </head>
    <body>
        <noscript><h1>Estapágina requiere el uso de JavaScript</h1></noscript>
        <div class="login_screen logged"><!-- class="anim" -->
            <div class="logo"></div>
            <input type="text" name="username" placeholder="username" class="input_logged"> <!-- class="input_logged" -->
            <input type="password" name="pswd" placeholder="password" class="input_logged"> <!-- class="input_logged" -->
            <input type="submit" name="login" value="Enter" class="">
        </div>
        <div>
            <header>
                <div></div>
                <div class="logo"></div>
                <div></div>
            </header>
            <main>
                <nav>
                    <?php
                        //Dinamic nav
                    ?>
                </nav>
                <?php
                    //Controller
                ?>
            </main>
            <footer></footer>
        </div>
        
    </body>
</html>