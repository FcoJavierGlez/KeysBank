<?php
    /**
     * @author Francisco Javier González Sabariego
     */

    include "config/config_dev.php";
    include "resource/functions.php";
    include "class/DBAbstractModel.php";
    include "class/Users.php";
    include "class/Platforms.php";
    include "class/Accounts.php";
    include "class/error/UserExistException.php";
    include "class/error/PassCheckException.php";
    include "class/error/MailFormatException.php";
    include "class/error/MailExistException.php";
    /* include "class/Clave.php";
    include "class/Documento.php";
    include "class/error/CheckOldPassException.php";
    include "class/error/TimeLimitException.php";
    require "phpmailer/class.phpmailer.php"; */

    session_start();

    $loggedNow   = FALSE;
    $errorLogin  = FALSE;
    $userPending = FALSE;
    $userBanned  = FALSE;

    if ( !isset($_SESSION['user']) ) { 
        $_SESSION['instance_users']      = Users::singleton();
        $_SESSION['instance_platforms']  = Platforms::singleton();
        $_SESSION['instance_accounts']   = Accounts::singleton();
        /* $_SESSION['clave']            = Clave::singleton();
        $_SESSION['documento']        = Documento::singleton();

        $_SESSION['mailer']           = NULL; */

        $_SESSION['user']             = array( 'perfil' => "INVITED" );
    }

    if ( isset($_POST['login']) ) {
        $usuario = $_SESSION['instance_users']->getUserByNick( dataClean($_POST['nick']) );
        if ( sizeof($usuario) && $usuario[0]['AES_DECRYPT(UNHEX(U.pass),K.password)'] == dataClean($_POST['pswd']) ) {
            if ($usuario[0]['current_state'] == 'PENDING') {
                $userPending = TRUE;
                $errorLogin = TRUE;
            }
            elseif($usuario[0]['current_state'] == 'BANNED') {
                $userBanned = TRUE;
                $errorLogin = TRUE;
            }
            else {
                $_SESSION['user']['id']                = $usuario[0]['id'];
                $_SESSION['user']['nick']              = $usuario[0]['nick'];
                $_SESSION['user']['pass']              = $usuario[0]['AES_DECRYPT(UNHEX(U.pass),K.password)'];
                $_SESSION['user']['name']              = $usuario[0]['AES_DECRYPT(UNHEX(U.name),K.password)'];
                $_SESSION['user']['surname']           = $usuario[0]['AES_DECRYPT(UNHEX(U.surname),K.password)'];
                $_SESSION['user']['email']             = $usuario[0]['email'];
                $_SESSION['user']['perfil']            = $usuario[0]['perfil'];
                $_SESSION['user']['current_state']     = $usuario[0]['current_state'];
                $_SESSION['user']['days_old_password'] = $usuario[0]['days_old_password'];
                $loggedNow = TRUE;
            }
            
        }
        else
            $errorLogin = TRUE;
    }

    if ( isset($_POST['exit']) ) {
        closeSession();
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Francisco Javier González Sabariego">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/form.css">
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="favicon.ico">
        <script src="js/functions.js"></script>
        <script src="js/main.js"></script>
        <title>KeysBank</title>
    </head>
    <body>
        <noscript><h1>Estapágina requiere el uso de JavaScript</h1></noscript>
        <div id="login_screen" class="<?php echo loginScreenVisibility($loggedNow); ?>">
            <div><a href="index.php"><div class="logo"></div></a></div>
            <?php 
                if ( isset($_GET['register']) ) {
                    if ($_SESSION['user']['perfil'] !== 'INVITED')
                        header('Location:index.php');
                    else
                        include "include/register_form.php"; 
                }
                else
                    include "include/login_form.php"; 
            ?>
        </div>
        <div>
            <header>
                <div></div>
                <a href="index.php"><div class="logo"></div></a>
                <div class="close-session">
                    <?php
                        if ($_SESSION['user']['perfil'] !== 'INVITED') {
                            echo "<form action='index.php' method='post'>";
                                echo "Welcome ".$_SESSION['user']['nick'].". ";
                                echo "<input type='submit' name='exit' value='Logout' class=''>";
                            echo "</form>";
                        }
                    ?>
                </div>
            </header>
            <main>
                <nav>
                    <?php
                        include "include/nav.php";
                    ?>
                </nav>
                <div class="container">
                    <div class="name-page"><h2><?php echo ($_SESSION['user']['perfil'] == 'INVITED' ? "" : "INDEX"); ?></h2></div>
                    <?php
                        //Controller
                    ?>
                </div>
            </main>
            <footer></footer>
        </div>
    </body>
</html>