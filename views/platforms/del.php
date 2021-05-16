<section>
    <div class='panel-title'>
        <div></div>
        <h3>DELETE</h3>
        <div></div>
    </div>
    <div class='account justify-content-center scroll'>
        <div class="fail_added_acc" >
            <div>This action is irreversible. If you delete this platform, the associated accounts will be deleted.</div>
            <div>Are you sure you want to delete this platform and all associated accounts?</div>
            <div class="panel-dual_button">
                <a href="platforms.php">
                    <button class="cancel">No</button>
                </a>
                <form action="platforms.php?deleted" method="POST">
                    <input type="hidden" name="idPlatform" value="<?php echo $_GET['del'] ?>">
                    <button class="accept" name="delete_platform">Yes</button>
                </form>
            </div>
        </div>
    </div>
</section>