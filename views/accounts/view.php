<?php
    /* echo "<section>";
    echo "<div class='panel-title'>";
        echo "<div></div>";
        echo "<h3>VIEW ACCOUNT</h3>";
        echo "<div><a href='".$_SERVER['PHP_SELF'].'?add'."'><button class='accept'>Add account</button></a></div>";
    echo "</div>";
    echo "<div class='search'>";
        echo "<form action='".$_SERVER['PHP_SELF']."' method='POST'>";
            echo "<input type='text' name='input_search' id='' placeholder='Search plataform'>";
            echo "<input type='submit' name='search_account' value='Search'>";
        echo "</form>";
    echo "</div>";
    echo "<div class='result scroll'>";
        echo "<article>";
            echo "<div class='platform'>";
                echo "<img src='../img/platform/".normalizeString($result_search[0]['name_platform']).".png' alt='Logo Twitter'>";
                echo "<h3>".$result_search[0]['name_platform'].":</h3>";
            echo "</div>";
            echo "<div class='basic-info'>";
                echo "<div><b><u>Account</u>:</b></div>";
                echo "<div><span>".$result_search[0]['AES_DECRYPT(UNHEX(A.name_account),K.password)']."</span></div>";
            echo "</div>";
        echo "</article>";
        echo "<pre>";
            print_r($result_search);
        echo "</pre>";
    echo "</div>";
    echo "</section>"; */
?>
<section>
    <div class='panel-title'>
        <div><a href='accounts.php'><button>Back</button></a></div>
        <h3>ACCOUNT</h3>
        <div</div>
    </div>
    <div class='result scroll'>
        <article>
            <div class='platform'>
                <img src="<?php echo '../img/platform/'.normalizeString($result_search[0]['name_platform']).'.png'; ?>" alt="<?php echo 'Logo '.$result_search[0]['name_platform']; ?>">
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
                    </div>
                    <div>
                        <span><?php echo replaceByCharacter($result_search[0]['AES_DECRYPT(UNHEX(A.pass_account),K.password)'],'*'); ?></span>
                        <input type="submit" id="cp_pss" value="Copy">
                    </div>
                </form>
            </div>
        </article>
    </div>
    </section>