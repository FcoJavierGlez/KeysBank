<div></div>
<a href="<?php echo (preg_match('/\/pages\//', $_SERVER['PHP_SELF']) ? '../index.php' : 'index.php'); ?>"><div class="logo"></div></a>
<div class="close-session">
    <?php
        if ($_SESSION['user']['perfil'] !== 'INVITED') {    //Si el usuario ya está logeado se carga el botón de logout
            echo "<form action='index.php' method='post'>";
                echo "Welcome ".$_SESSION['user']['nick'].". ";
                echo "<input type='submit' name='exit' value='Logout' class=''>";
            echo "</form>";
        }
    ?>
</div>