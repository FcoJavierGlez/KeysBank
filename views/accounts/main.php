<?php
    echo "<section>";
    echo "<div class='panel-title'>";
        echo "<div></div>";
        echo "<h3>LIST</h3>";
        echo "<div><a href='".$_SERVER['PHP_SELF'].'?add'."'><button class='accept'>Add account</button></a></div>";
    echo "</div>";
    echo "<div class='search'>";
        echo "<form action='".$_SERVER['PHP_SELF']."' method='POST'>";
            echo "<input type='text' name='input_search' id='' placeholder='Search platform'>";
            echo "<input type='submit' name='search_account' value='Search'>";
        echo "</form>";
    echo "</div>";
    echo "<div class='result scroll ".($emptyList || !sizeof($result_search) ? 'empty-search' : '')."'>";
        if ($emptyList)
            echo "<span><b>--- Empty account list ---</b></span>";
        elseif (!sizeof($result_search))
            echo "<span><b>--- Not found ---</b></span>";
        else 
            renderUserAccountList($result_search);
    echo "</div>";
    echo "</section>";
?>