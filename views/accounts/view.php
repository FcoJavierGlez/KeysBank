<?php
    $route = file_exists("../img/platform/".normalizeString($result_search[0]['name_platform']).".png") ? "../img/platform/".normalizeString($result_search[0]['name_platform']).".png" : "../img/platform/other.png";
?>
<section>
    <div class='panel-title'>
        <div><a href='accounts.php'><button class="back">Back</button></a></div>
        <h3>ACCOUNT</h3>
        <div</div>
    </div>
    <div class='result scroll'>
        <article>
            <div class='platform'>
                <img src="<?php echo $route; ?>" alt="<?php echo 'Logo '.$result_search[0]['name_platform']; ?>">
                <h3><?php echo $result_search[0]['name_platform']; ?>:</h3>
            </div>
            <div class='basic-info'>
                <form id="form-view">
                    <input type="hidden" name="search" value="<?php echo '?'.$_SESSION['user']['id'].'!'.$_GET['view']; ?>">
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
                    <div class="info">
                        <div id="shps" class="eye">
                            <input type="checkbox" name="shps">
                        </div>
                        <span><?php echo replaceByCharacter($result_search[0]['AES_DECRYPT(UNHEX(A.pass_account),K.password)'],'*'); ?></span>
                        <input type="submit" id="cp_pss" value="Copy">
                    </div>
                </form>
                <a href="<?php echo 'accounts.php?edit='.$result_search[0]['id']; ?>"> <!-- 'accounts.php?edit='.$result_search[0]['id'];  -->
                    <button class="edit">Edit</button>
                </a>
                <a href="<?php echo 'accounts.php?del='.$result_search[0]['id']; ?>">
                    <button class="cancel">Delete</button>
                </a>
            </div>
        </article>
    </div>
</section>