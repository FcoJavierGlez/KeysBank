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
?>
<div class="<?php echo $registered ? 'container-box' : 'hidden' ?>">
    <div class='registered-box'>
    <p>Succefully registered.</p>
    <p>Your account is pending to activated.</p>
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>"><button>Back to login</button></a>
    </div>
</div>

<form action="index.php?register" method="POST" class="<?php echo $registered ? 'hidden' : 'form_login'; ?>">
    <input type="text" name="nick" placeholder="nick (*)" class="<?php echo ($userExistException ? 'error' : 'required'); ?>"
        value="<?php echo ( isset($_POST['add_user']) ? $_POST['nick'] : '' ); ?>" required>
    <span class="text-error"><?php echo ($userExistException ? 'Nick is not available.' : ''); ?></span>

    <input type="password" name="pswd" placeholder="password (*)" class="<?php echo ($passCheckException ? 'error' : 'required'); ?>" value="" required>
    <input type="password" name="pswd2" placeholder="repeat password (*)" class="<?php echo ($passCheckException ? 'error' : 'required'); ?>" value='' required>
    <span class="text-error"><?php echo ($passCheckException ? 'Passwords must match.' : ''); ?></span>

    <input type="text" name="name" placeholder="name" value="<?php echo (isset($_POST['add_user']) ? $_POST['name'] : ''); ?>">
    <input type="text" name="surname" placeholder="surname" value="<?php echo (isset($_POST['add_user']) ? $_POST['surname'] : ''); ?>">

    <input type="email" name="email" placeholder="email (*)" class="<?php echo ($mailFormatException || $mailExistException ? 'error' : 'required'); ?>" 
        value="<?php echo (isset($_POST['add_user']) ? $_POST['email'] : ''); ?>" required>
    <span class="text-error"><?php echo ($mailFormatException ? 'Email format error.' : ''); ?></span>
    <span class="text-error"><?php echo ($mailExistException ? 'Email already registered.' : ''); ?></span>

    <input type="submit" name="add_user" value="Register" class="">
    <div><a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="back-login">Back to login</a></div>
</form>