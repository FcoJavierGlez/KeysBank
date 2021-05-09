<?php
    $registered          = FALSE;
    $userExistException  = FALSE;
    $mailFormatException = FALSE;
    $mailExistException  = FALSE;
    $passCheckException  = FALSE;

    if (isset($_POST['add_user'])) {
        try {
            $idUser   = 0;

            $user_data = array(
                'nick' => strtolower( dataClean($_POST['nick']) ),
                'pass' => dataClean($_POST['pswd']),
                'pass2' => dataClean($_POST['pswd2']),
                'name' => replaceCharacterByOtherCharacter( dataClean($_POST['name']), array(" ","'",'"',"&","|","<",">"), array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>") ),
                'surname' => replaceCharacterByOtherCharacter( dataClean($_POST['surname']), array(" ","'",'"',"&","|","<",">"), array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>") ),
                'email' => dataClean($_POST['email']),
            );

            //Creamos usuario
            $_SESSION['instance_users']->setUser($user_data);
            
            $registered = TRUE;
        } 
        catch (UserExistException $userExistException) {}
        catch (MailFormatException $mailFormatException) {}
        catch (MailExistException $mailExistException) {}
        catch (PassCheckException $passCheckException) {}
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

            echo "<input type='text' name='nick' placeholder='nick (*)' class='".($userExistException ? 'error' : 'required')."'
                value='".(isset($_POST['add_user']) ? $_POST['nick'] : '')."' required>";
            echo "<span class='text-error'>".($userExistException ? 'Nick is not available.' : '')."</span>";

            echo "<input type='password' name='pswd' placeholder='password (*)' class='".($passCheckException ? 'error' : 'required')."' value='' required>";
            echo "<input type='password' name='pswd2' placeholder='repeat password (*)' class='".($passCheckException ? 'error' : 'required')."' value='' required>";
            echo "<span class='text-error'>".($passCheckException ? 'Passwords must match.' : '')."</span>";

            echo "<input type='text' name='name' placeholder='name' value='".(isset($_POST['add_user']) ? $_POST['name'] : '')."'>";
            echo "<input type='text' name='surname' placeholder='surname' value='".(isset($_POST['add_user']) ? $_POST['surname'] : '')."'>";

            echo "<input type='email' name='email' placeholder='email (*)' class='".($mailFormatException || $mailExistException ? 'error' : 'required')."' 
                value='".(isset($_POST['add_user']) ? $_POST['email'] : '')."' required>";
            echo "<span class='text-error'>".($mailFormatException ? 'Email format error.' : '')."</span>";
            echo "<span class='text-error'>".($mailExistException ? 'This email has already been registered.' : '')."</span>";

            echo "<input type='submit' name='add_user' value='Register' class=''>";
            echo "<div><a href=".$_SERVER['PHP_SELF']." class='back-login'>Back to login</a></div>";
        echo "</form>";
    }
?>