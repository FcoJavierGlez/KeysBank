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
    /* include "../class/error/UserExistException.php";
    include "../class/error/PassCheckException.php";
    include "../class/error/MailFormatException.php";
    include "../class/error/MailExistException.php"; */
    /* include "../class/Clave.php";
    include "../class/Documento.php";
    include "../class/error/CheckOldPassException.php";
    include "../class/error/TimeLimitException.php";*/

    session_start();

    if ($_SESSION['user']['perfil'] !== "USER" || $_SESSION['user']['current_state'] !== "ACTIVE") {
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
                <div></div>
                <a href="../index.php"><div class="logo"></div></a>
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