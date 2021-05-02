<section class="<?php echo $edited_successfully ? '' : 'hidden'; ?>">
    <div class="panel-title">
        <div></div>
        <h3>EDITED</h3>
        <div></div>
    </div>
    <div class="result scroll">
        <div class="win_added_acc">
            <div>Your profile has been edited</div>
            <div>
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <button class="accept">Accept</button>
                </a>
            </div>
        </div>
    </div>
</section>
<section class="<?php echo $edited_successfully ? 'hidden' : ''; ?>">
    <div class="panel-title">
        <div></div>
        <h3>EDIT</h3>
        <div></div>
    </div>
    <div class="result scroll">
        <form class="perfil-info" action="<?php echo $_SERVER['PHP_SELF'].'?edit'; ?>" method="POST">
            <div class="perfil-data">
                <h3>User data</h3>
                <div class="container-data">
                    <div class="col2">
                        <div class="bold">Nick: </div>
                        <input type="text" name="nick" id="nick" class="<?php echo ($userExistException ? 'input-error' : ''); ?>" value="<?php echo ( $new_data_edit ? $_POST['nick'] : $_SESSION['user']['nick'] ); ?>">
                    </div>
                    <div class="col2">
                        <div class="bold">Name: </div>
                        <input type="text" name="name" id="name" value="<?php echo ( $new_data_edit ? $_POST['name'] : replaceCharacterByOtherCharacter( $_SESSION['user']['name'], array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>"), array(" ","'",'"',"&","|","<",">") ) ); ?>">
                    </div>
                    <div class="col2">
                        <div class="bold">Surname: </div>
                        <input type="text" name="surname" id="surname" value="<?php echo ( $new_data_edit ? $_POST['surname'] : replaceCharacterByOtherCharacter( $_SESSION['user']['surname'], array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>"), array(" ","'",'"',"&","|","<",">") ) ); ?>">
                    </div>
                    <div class="col2">
                        <div class="bold">Email: </div>
                        <input type="mail" name="email" id="email" class="<?php echo ($mailFormatException || $mailExistException ? 'input-error' : ''); ?>" value="<?php echo ( $new_data_edit ? $_POST['email'] : $_SESSION['user']['email'] ); ?>">
                    </div>
                    <div class="col2">
                        <div><a href="<?php echo $_SERVER['PHP_SELF'].'?edit_password' ?>"><div class="div-copy_button">Edit pass</div></a></div>
                        <div id="password"><?php echo replaceByCharacter($_SESSION['user']['pass'],'*'); ?></div>
                    </div>
                    <input type="hidden" value="<?php echo $_SESSION['user']['pass']; ?>">
                    <div class="special_message">
                        <span id="password_strength"></span>
                    </div>
                </div>
                <hr>
                <h3>App config</h3>
                <div class="container-data">
                    <div class="col2">
                        <div class="bold">Notify old password: </div> <div><input type="number" name="days_old_password" id="days_old_password" value="<?php echo ( $new_data_edit ? $_POST['days_old_password'] : $_SESSION['user']['days_old_password'] ); ?>"> days</div>
                    </div>
                </div>
                <div class="<?php echo ($userExistException || $mailFormatException || $mailExistException ? 'alert' : '');  ?>">
                    <?php 
                        if ($userExistException)
                            echo 'Username is not available';
                        elseif ($mailFormatException)
                            echo 'Email format error';
                        elseif ($mailExistException)
                            echo 'This email has already been registered';
                    ?>
                </div>
            </div>
            <div class="panel-dual_button">
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>"><div class="div-cancel_button">Cancel</div></a>
                <a href="<?php echo $_SERVER['PHP_SELF'].'?edit'; ?>"><button class="accept" name="update_profile">Accept</button></a>
            </div>
        </form>
    </div>
</section>