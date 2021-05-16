<section>
    <div class='panel-title'>
        <div></div>
        <h3>LIST</h3>
        <div><a href='<?php echo $_SERVER['PHP_SELF'].'?add'; ?>'><button class='accept'>Add platform</button></a></div>
    </div>
    <div class='search'>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='POST'>
            <input type='text' name='input_search' id='' placeholder='Search platform'>
            <input type='submit' name='search_platform' value='Search'>
        </form>
    </div>
    <div class="<?php echo "result scroll ".($emptyList || !sizeof($result_search) ? 'empty-search' : 'user-list') ?>">
        <?php
            if ($emptyList)
                echo "<span><b>--- Empty platforms list ---</b></span>";
            elseif (!sizeof($result_search))
                echo "<span><b>--- Not found ---</b></span>";
            else 
                renderTablePlatformList($categories, $result_search);
        ?>
    </div>
</section>