<?php
    /**
     * @author Francisco Javier González Sabariego
     */

    include "../config/config_dev.php";
    include "../resource/functions.php";
    include "../class/DBAbstractModel.php";
    include "../class/Platforms.php";

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
        <link rel="stylesheet" href="../css/normalize.css">
        <link rel="stylesheet" href="../css/form.css">
        <link rel="stylesheet" href="../css/login.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" href="../favicon.ico">
        <script src="../js/functions.js"></script>
        <script src="../js/selects/select_categories.js"></script>
        <script src="../js/selects/select_subcategories.js"></script>
        <script src="../js/platforms/preview_logo.js"></script>
        <script src="../js/platforms/add_edit.js"></script>
        <script src="../js/platforms/delete_platform.js"></script>
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
                    <div class="name-page"><h2>PLATFORMS</h2></div>
                    <?php
                        include '../controller/platform_controller.php';
                    ?>
                </div>
            </main>
            <footer></footer>
        </div>
    </body>
</html>