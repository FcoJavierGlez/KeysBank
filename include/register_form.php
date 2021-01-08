<?php
    $registered = FALSE;

    if (isset($_POST['register'])) {
        try {
            $registered = TRUE;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    if ($registered) {
        echo "<div class='container-box'>";
            echo "<div class='registered-box'>";
            echo "<p>Succefully registered.</p>";
            echo "<p>Your account is pending to activated.</p>";
            echo "<a href=".$_SERVER['PHP_SELF']."><button>Back to login</button></a>";
            echo "</div>";
        echo "</div>";
    }
    else {
        echo "<form action=".$_SERVER['PHP_SELF'].'?register'." method='POST' class='form_login'>";
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
    }
    
?>