<section>
    <div class="panel-title">
        <div></div>
        <h3>VIEW</h3>
        <div></div>
    </div>
    <div class="result scroll">
        <div class="perfil-info">
            <div class="perfil-data">
                <h3>User data</h3>
                <div class="container-data">
                    <div class="col2">
                        <div class="bold">Nick: </div>
                        <div id="nick"><?php echo $_SESSION['user']['nick']; ?></div>
                    </div>
                    <div class="col2">
                        <div class="bold">Name: </div>
                        <div><?php echo replaceCharacterByOtherCharacter( $_SESSION['user']['name'], array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>"), array(" ","'",'"',"&","|","<",">") ); ?></div>
                    </div>
                    <div class="col2">
                        <div class="bold">Surname: </div>
                        <div><?php echo replaceCharacterByOtherCharacter( $_SESSION['user']['surname'], array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>"), array(" ","'",'"',"&","|","<",">") ); ?></div>
                    </div>
                    <div class="col2">
                        <div class="bold">Email: </div>
                        <div><?php echo $_SESSION['user']['email']; ?></div>
                    </div>
                    <div class="col2">
                        <div class="bold">Password: </div>
                        <div><?php echo replaceByCharacter($_SESSION['user']['pass'],'*'); ?></div>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $_SESSION['user']['id']; ?>">
                    </form>
                    <div class="special_message">
                        <span id="password_strength"></span>
                    </div>
                </div>
                <hr>
                <h3>App config</h3>
                <div class="container-data">
                    <div class="col2">
                        <div class="bold">Notify old password: </div> <div><?php echo $_SESSION['user']['days_old_password']." days"; ?></div>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <a href="<?php echo $_SERVER['PHP_SELF'].'?edit' ?>"><button class="back">Edit</button></a>
            </div>
        </div>
    </div>
</section>