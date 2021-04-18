<?php
    $route = file_exists("../img/platform/".normalizeString($result_search[0]['name_platform']).".png") ? "../img/platform/".normalizeString($result_search[0]['name_platform']).".png" : "../img/platform/other.png";
?>
<section>
    <div class='panel-title'>
        <div><a href='accounts.php'><button class="back">Back</button></a></div>
        <h3>ACCOUNT</h3>
        <div</div>
    </div>
    <div class='account scroll'>
        <article>
            <div class='platform'>
                <img src="<?php echo $route; ?>" alt="<?php echo 'Logo '.$result_search[0]['name_platform']; ?>">
                <h3><?php echo $result_search[0]['name_platform']; ?>:</h3>
            </div>
            <div class='basic-info'>
                <form id="form-view">
                    <input type="hidden" name="search" value="<?php echo $_GET['view']; ?>">
                    <fieldset>
                        <legend>Access - Login</legend>
                        <fieldset class="<?php echo ($result_search[0]['AES_DECRYPT(UNHEX(A.url),K.password)'] !== "" ? "" : 'hidden'); ?>">
                            <legend>Address account</legend>
                            <div>
                                <b><u>URL / IP</u>:</b>
                            </div>
                            <div>
                                <span>
                                    <?php
                                        echo (
                                            $result_search[0]['AES_DECRYPT(UNHEX(A.url),K.password)'] !== "" ? 
                                            "<a href='".$result_search[0]['AES_DECRYPT(UNHEX(A.url),K.password)']."' target='_blank'>".$result_search[0]['AES_DECRYPT(UNHEX(A.url),K.password)']."</a>" :
                                            "Not available"
                                        );
                                    ?>
                                </span>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Data login</legend>
                            <div>
                                <b><u>Account</u>:</b>
                            </div>
                            <div>
                                <span><?php echo $result_search[0]['AES_DECRYPT(UNHEX(A.name_account),K.password)']; ?></span>
                            </div>
                            <div>
                                <b><u>Pass</u>:</b>
                                <span class="alert"><?php echo $result_search[0]['DATEDIFF(CURDATE(), A.pass_date)'] >= 90 ? "PASSWORD TOO OLD" : ""; ?></span>
                            </div>
                            <div class="box-info">
                                <div class="info">
                                    <div id="shps" class="eye">
                                        <input type="checkbox" name="shps">
                                    </div>
                                    <div class="word-break"><?php echo replaceByCharacter($result_search[0]['AES_DECRYPT(UNHEX(A.pass_account),K.password)'],'*'); ?></div>
                                </div>
                                <div class="text-right">
                                    <input type="submit" id="cp_pss" value="Copy" class="copy">
                                </div>
                            </div>
                        </fieldset>
                    </fieldset>
                    <fieldset>
                        <legend>Aditional data</legend>
                        <fieldset>
                            <legend>Notes</legend>
                            <div class="div_textarea">
                                <div><u>Personal notes</u>:</div>
                                <div class="div_pass">
                                    <div></div>
                                    <textarea name="notes" id="notes" maxlength="255" disabled><?php echo replaceCharacterByOtherCharacter( $result_search[0]['AES_DECRYPT(UNHEX(A.notes),K.password)'], array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>"), array(" ","'",'"',"&","|","<",">") ); ?></textarea>
                                </div>
                                <div></div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Sensible info</legend>
                            <div class="div_textarea">
                                <div><u>Aditional info</u>:</div>
                                <div class="div_pass">
                                    <div id="shinfo" class="eye">
                                        <input type="checkbox" name="shinfo">
                                    </div>
                                    <textarea name="info" id="info" maxlength="255" disabled><?php echo replaceByCharacter( replaceCharacterByOtherCharacter( $result_search[0]['AES_DECRYPT(UNHEX(A.info),K.password)'], array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>"), array(" ","'",'"',"&","|","<",">") ), '*' ); ?></textarea>
                                </div>
                                <div></div>
                            </div>
                        </fieldset>
                    </fieldset>
                </form>
                <div class="panel-dual_button">
                    <a href="<?php echo '#'; ?>"> <!-- 'accounts.php?edit='.$result_search[0]['id'];  -->
                        <button class="back">Edit</button>
                    </a>
                    <a href="<?php echo 'accounts.php?del='.$result_search[0]['id']; ?>">
                        <button class="cancel">Delete</button>
                    </a>
                </div>
            </div>
        </article>
    </div>
</section>