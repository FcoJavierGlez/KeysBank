<section>
    <div class='panel-title'>
        <div><a href='<?php echo $_SERVER['PHP_SELF']; ?>'><button class='back'>Back</button></a></div>
        <h3>ADD</h3>
        <div></div>
    </div>
    <div class="<?php if ($actionSuccessfully || $existPlatform) echo $actionSuccessfully ? "win_added_acc" : "fail_added_acc"; else echo 'hidden' ?>" >
        <div><?php echo $actionSuccessfully ? "Added platform succesfully" : "The platform already exists"; ?></div>
        <div>
            <a href="platforms.php">
                <button class="accept">Accept</button>
            </a>
        </div>
    </div>
    <div class="<?php echo $actionSuccessfully || $existPlatform ? 'hidden' : 'perfil-info' ?>">
        <form action="<?php echo $_SERVER['PHP_SELF'].'?add'; ?>" method="POST" id="platform" enctype="multipart/form-data">
            <fieldset>
                <legend>Required</legend>
                <fieldset>
                    <legend>Category - subcategory</legend>
                    <div class="div_select">
                        <div>Categories:</div>
                        <select name="categories" id="categories"></select>
                        <div class="special_message">
                            <span class="text-error"></span>
                        </div>
                    </div>
                    <div class="div_select">
                        <div>Platforms:</div>
                        <select name="subcategories" id="subcategories">
                            <option value="">-- Choice an option --</option>
                        </select>
                        <div class="special_message">
                            <span class="text-error"></span>
                        </div>
                    </div>
                    <div class="div_input">
                            <div>Account name:</div>
                            <input type="text" name="name" id="name" class="required" placeholder="required (*)">
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
                            <p>No files currently selected for upload</p>
                        </div>
                    </div>
                    <div id="error"></div>
                    <div>
                        <label for="profile_pic">Choose an image to upload (PNG)(Size-Max: 50KB)</label><br>
                        <input type="hidden" name="MAX_FILE_SIZE" value="51200" />
                        <input type="file" id="logo" name="logo" accept=".png">
                    </div>
                </fieldset>
            </fieldset>
            <div>
                <input type="submit" id ="send" name="add_platform" value="Accept" class="accept">
            </div>
        </form>
    </div>
</section>