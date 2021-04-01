<section>
    <div class='panel-title'>
        <div><a href='accounts.php'><button class="back">Back</button></a></div>
        <h3>ADD</h3>
        <div</div>
    </div>
    <div class='result scroll'>
        <article>
            <!-- <div class='platform'>
                <img src="<?php echo '../img/platform/'.normalizeString($result_search[0]['name_platform']).'.png'; ?>" alt="<?php echo 'Logo '.$result_search[0]['name_platform']; ?>">
                <h3><?php echo $result_search[0]['name_platform']; ?>:</h3>
            </div> -->
            <div class='basic-info'>
                <form id="form-add">
                <fieldset class="select_platform">
                    <legend>Category - subcategory</legend>
                    <div class="div_select">
                        <div>
                            Categories:
                        </div>
                        <select name="categories" id="categories"></select>
                    </div>
                    <div class="div_select">
                        <div>
                            Subcategories: 
                        </div>
                        <select name="subcategories" id="subcategories">
                            <option value="">-- Choice an option --</option>
                        </select>
                    </div>
                </fieldset>
                    <!-- <input type="hidden" name="search" value="<?php echo '?'.$_SESSION['user']['id'].'!'.$_GET['view']; ?>">
                    <div>
                        <b><u>Account</u>:</b>
                    </div>
                    <div>
                        <span><?php echo $result_search[0]['AES_DECRYPT(UNHEX(A.name_account),K.password)']; ?></span>
                    </div>
                    <div>
                        <b><u>Pass</u>:</b>
                    </div>
                    <div>
                        <span><?php echo replaceByCharacter($result_search[0]['AES_DECRYPT(UNHEX(A.pass_account),K.password)'],'*'); ?></span>
                        <input type="submit" id="cp_pss" value="Copy">
                    </div> -->
                </form>
            </div>
        </article>
    </div>
    </section>