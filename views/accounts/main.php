<?php
    echo "<section>";
    echo "<div class='panel-title'><h3>LIST</h3></div>";
    echo "<div class='search'>";
        echo "<form action='".$_SERVER['PHP_SELF']."' method='POST'>";
            echo "<input type='text' name='input_search' id='' placeholder='Search plataform'>";
            echo "<input type='submit' name='search_account' value='Search'>";
        echo "</form>";
    echo "</div>";
    echo "<div class='result scroll'>";
        if ($emptyList)
            echo "<span><b>-- Your accounts list is empty --</b></span>";
        elseif (!sizeof($result_search))
            echo "<span><b>-- Not found --</b></span>";
        else 
            renderUserAccountList($result_search);
    echo "</div>";
    echo "</section>";
?>