<section>
    <div class='panel-title'>
        <div><a href='accounts.php?view=<?php echo $_GET['del'] ?>'><button class="back">Back</button></a></div>
        <h3>DELETE</h3>
        <div></div>
    </div>
    <div class='result scroll'>
        <div class="fail_added_acc" >
            <div>This action is irreversible. If you delete this account, your data will not be recovered.</div>
            <div>Are you sure you want to delete this account?</div>
            <div class="panel-dual_button">
                <a href="accounts.php?view=<?php echo $_GET['del'] ?>">
                    <button class="cancel">No</button>
                </a>
                <form action="accounts.php?deleted" method="post">
                    <input type="hidden" name="id_account" value="<?php echo $_GET['del'] ?>">
                    <button class="accept" name="delete_account">Yes</button>
                </form>
            </div>
        </div>
    </div>
</section>