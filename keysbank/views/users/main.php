<section>
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
</section>