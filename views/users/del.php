<!-- <section>
    <div class='panel-title'>
        <div></div>
        <h3>LIST</h3>
        <div></div>
    </div>
    <div class='search'>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='POST'>
            <input type='text' name='input_search' id='' placeholder='Search nick / mail'>
            <input type='submit' name='search_user' value='Search'>
        </form>
    </div>
    <div class="<?php echo "result scroll ".($emptyList || !sizeof($result_search) ? 'empty-search' : 'user-list') ?>">
        <?php
            if ($emptyList)
                echo "<span><b>--- Empty users list ---</b></span>";
            elseif (!sizeof($result_search))
                echo "<span><b>--- Not found ---</b></span>";
            else 
                renderUserList($result_search);
        ?>
    </div>
</section> -->
<section>
    <div class='panel-title'>
        <div></div>
        <h3>DELETE</h3>
        <div></div>
    </div>
    <div class='account justify-content-center scroll'>
        <div class="fail_added_acc" >
            <div>This action is irreversible. If you delete this user, his data will not be recovered.</div>
            <div>Are you sure you want to delete this user and all accounts and keys?</div>
            <div class="panel-dual_button">
                <a href="users.php">
                    <button class="cancel">No</button>
                </a>
                <form action="users.php?deleted" method="post">
                    <input type="hidden" name="idUser" value="<?php echo $_GET['del'] ?>">
                    <button class="accept" name="delete_user">Yes</button>
                </form>
            </div>
        </div>
    </div>
</section>