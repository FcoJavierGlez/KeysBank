<?php
    /**
     * @author Francisco Javier González Sabariego
     */

    include "../config/config_dev.php";
    include "../resource/functions.php";
    include "../class/DBAbstractModel.php";
    include "../class/Users.php";
    include "../class/Platforms.php";
    include "../class/Accounts.php";

    session_start();

    include '../controller/routes/users.php';   //Acceso solo para usuarios activados
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
        <link rel="icon" href="../favicon.ico">
        <script src="../js/functions.js"></script>
        <script src="../js/passManager.js"></script>
        <script src="../js/selects/select_categories.js"></script>
        <script src="../js/selects/select_platforms.js"></script>
        <script src="../js/accounts/add_account.js"></script>
        <script src="../js/accounts/delete_account.js"></script>
        <script src="../js/accounts/edit_account.js"></script>
        <script src="../js/accounts/view_account.js"></script>
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
                    <div class="name-page"><h2>ACCOUNTS</h2></div>
                    <?php
                        include "../controller/accounts_controller.php";
                    ?>
                </div>
            </main>
            <footer></footer>
        </div>
    </body>
</html>