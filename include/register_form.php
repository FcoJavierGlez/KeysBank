<?php
    echo "<form action='index.php' method='POST' class='form_login'>";
    echo "<input type='text' name='nick' placeholder='nick' class=".inputStyle($errorLogin,$loggedNow)." value=".
    (isset($_POST['nick']) ? dataClean($_POST['nick']) : '').">";
        echo "<input type='password' name='pswd' placeholder='password' class=".inputStyle($errorLogin,$loggedNow).">";
        echo "<input type='password' name='rep_pswd' placeholder='repeat password' class=".inputStyle($errorLogin,$loggedNow).">";
        echo "<input type='text' name='name' placeholder='name' class=".inputStyle($errorLogin,$loggedNow).">";
        echo "<input type='text' name='surname' placeholder='surname' class=".inputStyle($errorLogin,$loggedNow).">";
        echo "<input type='email' name='email' placeholder='email' class=".inputStyle($errorLogin,$loggedNow).">";
        /* echo "<span class='text-error'>".($errorLogin ? 'Usuario y/o contraseñas incorrectos' : '')."</span>"; */
        echo "<input type='submit' name='register' value='Register' class=''>";
        echo "<a href=".$_SERVER['PHP_SELF']." class='back-login'>Back to login</a>";
    echo "</form>";
?>