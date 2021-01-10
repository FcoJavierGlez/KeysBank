<?php
    /**
     * @author Francisco Javier González Sabariego
     */

    include "../config/config_dev.php";
    include "../resource/functions.php";
    /* include "../class/DBAbstractModel.php";
    include "../class/Users.php";
    include "../class/Plataforms.php";
    include "../class/error/UserExistException.php";
    include "../class/error/PassCheckException.php";
    include "../class/error/MailFormatException.php";
    include "../class/error/MailExistException.php"; */
    /* include "../class/Clave.php";
    include "../class/Documento.php";
    include "../class/error/CheckOldPassException.php";
    include "../class/error/TimeLimitException.php";*/

    session_start();

    if ($_SESSION['user']['perfil'] !== "ADMIN") {
        header('Location:../index.php');
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Francisco Javier González Sabariego">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" href="../favicon.ico">
        <!-- <script src="../js/main.js"></script> -->
        <title>KeysBank</title>
    </head>
    <body>
        <noscript><h1>Estapágina requiere el uso de JavaScript</h1></noscript>
        <div>
            <header>
                <div></div>
                <div class="logo"></div>
                <div class="close-session">
                    <?php
                        if ($_SESSION['user']['perfil'] !== 'INVITED') {
                            echo "<form action='../index.php' method='post'>";
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
                        include "../include/nav.php";
                    ?>
                </nav>
                <div class="container">
                    <h2>Welcome to plataforms</h2>
                    <?php
                        //Controller
                    ?>
                </div>
            </main>
            <footer></footer>
        </div>
        
    </body>
</html>