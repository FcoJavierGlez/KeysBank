<section>
    <div class='panel-title'>
        <div><a href='<?php echo $_SERVER['PHP_SELF']; ?>'><button class='back'>Back</button></a></div>
        <h3>EDIT</h3>
        <div></div>
    </div>
    <div class="<?php $successfulAction ? "win_added_acc" : "hidden"; ?>" >
        <div><?php echo $successfulAction ? "Updated platform succesfully" : ""; ?></div>
        <div>
            <a href="platforms.php" class="<?php echo $successfulAction ? '' : 'hidden' ?>">
                <button class="accept">Accept</button>
            </a>
        </div>
    </div>
    <div class="<?php echo $successfulAction ? 'hidden' : 'perfil-info' ?>">
        <form action="<?php echo $_SERVER['PHP_SELF'].'?edited'; ?>" method="POST" id="platform" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $search_platform[0]['id']; ?>">
            <fieldset>
                <legend>Required</legend>
                <fieldset>
                    <legend>Category - subcategory</legend>
                    <div class="div_select">
                        <div>Categories: </div><div class="capitalice"><?php echo replaceCharacterByOtherCharacter($search_platform[0]['category'],array("_"),array(" ")) ?></div>
                    </div>
                    <div class="div_select">
                        <div>Platforms:</div>
                        <?php
                            renderSubcategorySelect($subcategories, $search_platform[0]['subcategory']);
                        ?>
                        <div class="special_message">
                            <span class="text-error"></span>
                        </div>
                    </div>
                    <div class="div_input">
                            <div>Account name:</div>
                            <input type="text" name="name" id="name" class="required" placeholder="required (*)" value="<?php echo $search_platform[0]['name']; ?>">
                            <div class="special_message">
                                <span class="text-error"></span>
                            </div>
                        </div>
                </fieldset>
            </fieldset>
            <fieldset>
                <legend>Optional</legend>
                <fieldset>
                    <legend>Platform logo</legend>
                    <div class="preview">
                        <div class="preview_logo">
                            <img src="../img/platform/<?php echo $logo; ?>">
                            <p>Current logo available for this platform</p>
                        </div>
                    </div>
                    <div id="error"></div>
                    <div>
                        <label for="profile_pic"><u>Choose an image to upload</u>: <b>(PNG) (Size-Max: 50KB)</b></label><br>
                        <input type="hidden" name="MAX_FILE_SIZE" value="51200" />
                        <input type="file" id="logo" name="logo" accept=".png">
                    </div>
                </fieldset>
            </fieldset>
            <div id="message_error"></div>
            <div>
                <input type="submit" id ="send" name="edit_platform" value="Accept" class="accept">
            </div>
        </form>
    </div>
</section>