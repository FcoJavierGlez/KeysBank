<?php
    /**
     * @author Francisco Javier González Sabariego
     */

    include "../config/config_dev.php";
    include "../resource/functions.php";
    include "../class/DBAbstractModel.php";
    include "../class/Users.php";
    include "../class/error/UserExistException.php";
    include "../class/error/CheckOldPassException.php";
    include "../class/error/PassCheckException.php";
    include "../class/error/MailFormatException.php";
    include "../class/error/MailExistException.php";

    session_start();

    include '../controller/routes/both.php';    //Acceso para usuarios activados y administrador
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="author" content="Francisco Javier González Sabariego">
        <link rel="stylesheet" href="../css/normalize.css">
        <link rel="stylesheet" href="../css/form.css">
        <link rel="stylesheet" href="../css/login.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" href="../img/favicon.ico">
        <script src="../js/functions.js"></script>
        <script src="../js/passManager.js"></script>
        <script src="../js/profile/edit_profile.js"></script>
        <script src="../js/profile/edit_profile_password.js"></script>
        <title>KeysBank</title>
    </head>
    <body>
        <noscript><h1>Esta página requiere el uso de JavaScript</h1></noscript>
        <div>
            <header>
                <?php
                    include '../include/header.php';
                ?>
            </header>
            <main>
                <nav>
                    <?php
                        include "../include/nav.php";
                    ?>
                </nav>
                <div class="container">
                    <div class="name-page"><h2>PROFILE</h2></div>
                    <?php
                        include "../controller/profile_controller.php";
                    ?>
                </div>
            </main>
            <footer></footer>
        </div>
    </body>
</html>