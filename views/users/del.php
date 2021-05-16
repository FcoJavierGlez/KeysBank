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