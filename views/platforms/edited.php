<section>
    <div class='panel-title'>
        <div><a href='<?php echo $_SERVER['PHP_SELF']; ?>'><button class='back'>Back</button></a></div>
        <h3>EDITED</h3>
        <div></div>
    </div>
    <div class="<?php echo $successfulAction ? "win_added_acc" : "fail_added_acc" ?>" >
        <div>
            <?php 
                if ($successfulAction)
                    echo "Updated platform succesfully";
                elseif ($actionFailed)
                    echo "Error: Action failed";
                elseif ($existPlatform)
                    echo "The platform already exists";
            ?>
        </div>
        <div>
            <a href="platforms.php">
                <button class="accept">Accept</button>
            </a>
        </div>
    </div>
</section>