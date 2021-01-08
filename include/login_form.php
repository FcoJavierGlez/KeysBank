<?php
    echo "<form action='index.php' method='POST' class='form_login'>";
        echo "<input type='text' name='nick' placeholder='nick' class=".inputStyle($errorLogin,$loggedNow)." value=".
        (isset($_POST['nick']) ? dataClean($_POST['nick']) : '').">";
        echo "<input type='password' name='pswd' placeholder='password' class=".inputStyle($errorLogin,$loggedNow).">";
        echo "<span class='text-error'>".($errorLogin ? 'Usuario y/o contraseña incorrectos' : '')."</span>";
        echo "<input type='submit' name='login' value='Enter' class=''>";
        echo "<div><a href=".$_SERVER['PHP_SELF'].'?register'." class='register'>Register now</a></div>";
    echo "</form>";
?>