<?php
    /**
     * @author Francisco Javier González Sabariego
     */

    include "config/config_dev.php";
    include "resource/functions.php";
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
        /* $_SESSION['usuario']          = Usuario::singleton();
        $_SESSION['clave']            = Clave::singleton();
        $_SESSION['documento']        = Documento::singleton();

        $_SESSION['mailer']           = NULL; */

        $_SESSION['user']             = array( 'perfil' => "INVITED" );
    }

    if ( isset($_POST['login']) ) {
        /* $usuario = $_SESSION['usuario']->getUserByNick( limpiarDatos($_POST['user']) );
        if ( sizeof($usuario) && $usuario[0]['pass'] == limpiarDatos($_POST['pswd']) ) {
            $_SESSION['user'] = $usuario[0];
            $logged = TRUE;
        } */
        $loggedNow = TRUE;
        $_SESSION['user']['perfil'] = 'USER'; //prueba
        $_SESSION['user']['nick']   = 'user1'; //prueba
    }

    if ( isset($_POST['exit']) ) {
        closeSession();
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
        <div id="login_screen" class="<?php echo loginScreenVisibility($loggedNow); ?>"><!-- class="login_screen logged" -->
            <div class="logo"></div>
            <form action="" method="post" class="form-login">
                <input type="text" name="username" placeholder="username" class="<?php echo $loggedNow ? 'input_logged' : ''; ?>"> <!-- class="input_logged" -->
                <input type="password" name="pswd" placeholder="password" class="<?php echo $loggedNow ? 'input_logged' : ''; ?>"> <!-- class="input_logged" -->
                <input type="submit" name="login" value="Enter" class="">
            </form>
        </div>
        <div>
            <header>
                <div></div>
                <div class="logo"></div>
                <div class="close-session">
                    <?php
                        if ($_SESSION['user']['perfil'] !== 'INVITED') {
                            echo "<form action='' method='post'>";
                                echo "Welcome ".$_SESSION['user']['nick'].". ";
                                echo "<input type='submit' name='exit' value='Close' class=''>";
                            echo "</form>";
                        }
                    ?>
                </div>
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