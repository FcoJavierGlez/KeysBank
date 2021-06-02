<section class="<?php echo $edited_successfully ? '' : 'hidden'; ?>">
    <div class="panel-title-flex">
        <div></div>
        <h3>EDIT</h3>
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
    <div class="panel-title-flex">
        <div></div>
        <h3>EDIT PASSWORD</h3>
        <div></div>
    </div>
    <div class="result scroll">
        <form class="perfil-info" action="<?php echo $_SERVER['PHP_SELF'].'?edit_password'; ?>" method="POST">
            <div class="perfil-data">
                <h3>Old password</h3>
                <div class="container-data">
                    <div class="col2">
                        <div class="bold">Old password</div>
                        <div class="div_pass">
                            <div id="shops" class="eye">
                                <input type="checkbox" name="shops">
                            </div>
                            <input type="password" name="old_pass" id="old_pass" class="<?php echo $checkOldPassException ? 'input-error' : ''; ?>" value="<?php echo $new_data_edit && !$checkOldPassException ? $_POST['new_pass'] : ''; ?>">
                        </div>
                    </div>
                    <input type="hidden" value="<?php echo $_SESSION['user']['nick']; ?>">
                    <input type="hidden" value="<?php echo $_SESSION['user']['perfil']; ?>">
                </div>
                <hr>
                <h3>New password</h3>
                <div class="container-data">
                    <div class="col2">
                        <div class="bold">New password</div>
                        <div class="div_pass">
                            <div id="shops" class="eye">
                                <input type="checkbox" name="shops">
                            </div>
                            <input type="password" name="new_pass" id="new_pass" class="<?php echo $passCheckException ? 'input-error' : ''; ?>" value="<?php echo $passCheckException ? $_POST['new_pass'] : ''; ?>">
                        </div>
                    </div>
                    <div class="col2">
                        <div class="bold">Repeat</div>
                        <div class="div_pass">
                            <div id="shops" class="eye">
                                <input type="checkbox" name="shops">
                            </div>
                            <input type="password" name="new_pass2" id="new_pass2" class="<?php echo $passCheckException ? 'input-error' : ''; ?>" value="<?php echo $passCheckException ? $_POST['new_pass2'] : ''; ?>">
                        </div>
                    </div>
                    <div class="special_message">
                        <span id="password_strength"></span>
                    </div>
                    <div class="alert" id="alert"></div>
                </div>
                <div class="<?php echo ($passCheckException || $checkOldPassException ? 'alert' : '');  ?>">
                    <?php 
                        if ($checkOldPassException)
                            echo 'Current password incorrect';
                        elseif ($passCheckException)
                            echo 'Passwords must match';
                    ?>
                </div>
            </div>
            <div class="panel-dual_button">
                <a href="<?php echo $_SERVER['PHP_SELF'].'?edit'; ?>"><div class="div-cancel_button">Cancel</div></a>
                <a href="<?php echo $_SERVER['PHP_SELF'].'?edit_password'; ?>"><button class="accept" name="update_password">Accept</button></a>
            </div>
        </form>
    </div>
</section>