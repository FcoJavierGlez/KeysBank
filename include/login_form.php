<?php
    echo "<form action='index.php' method='POST' class='form_login'>";
        echo "<input type='text' name='username' placeholder='username' class=".inputStyle($errorLogin,$loggedNow)." value=".
        (isset($_POST['username']) ? dataClean($_POST['username']) : '').">";
        echo "<input type='password' name='pswd' placeholder='password' class=".inputStyle($errorLogin,$loggedNow).">";
        echo "<span class='text-error'>".($errorLogin ? 'Usuario y/o contraseñas incorrectos' : '')."</span>";
        echo "<input type='submit' name='login' value='Enter' class=''>";
        echo "<a href=".$_SERVER['PHP_SELF'].'?page=register'." class='register'>Register now</a>";
    echo "</form>";
?>