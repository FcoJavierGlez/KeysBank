<?php
    /**
     * @author Francisco Javier González Sabariego
     * 
     * Página de inicio. Página principal de la app.
     * 
     * En esta página se cargan las variables de sesión y se validan
     * los formularios de login y de registro.
     * 
     * En caso de login exitoso se cargan los datos del usuario en su variable de sesión $_SESSION['user'], 
     * de lo contrario no se cargan datos y su perfil permanecerá como 'INVITED' (perfil inicial por defecto).
     * 
     * Si el perfil del usuario cambia de 'INVITED' a 'USER' o 'ADMIN' se ocultará el formulario de login y 
     * se creará dinámicamente los botones de la barra de nav (en función de si el perfil es 'USER' o 'ADMIN') 
     * y se mostrará en la vista un saludo y (en el futuro) datros de interés para la persona que haya hecho login.
     * 
     * Mientras el perfil sea 'INVITED' el usuario, aunque oculte el panel de login, verá una app vacía sin botones
     * en el nav ni ningún tipo de información. Además, sobra decir, que mientras permanezca como 'INVITED' tampoco
     * podrá acceder por URL a ninguna otra página (ni vista respectiva a la misma) de la app y que, de existir 
     * dicha página se le redireccionará inmediatamente al index con la vista del formulario de login.
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

    session_start();

    if ( !isset($_SESSION['user']) ) { 
        $_SESSION['instance_users']      = Users::singleton();
        $_SESSION['instance_platforms']  = Platforms::singleton();
        $_SESSION['instance_accounts']   = Accounts::singleton();

        $_SESSION['user']             = array( 'perfil' => "INVITED" );
    }

    include 'controller/login_register_controller.php';

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
                        if ($_SESSION['user']['perfil'] !== 'INVITED')
                            include "views/index/main.php";
                    ?>
                </div>
            </main>
            <footer></footer>
        </div>
    </body>
</html>