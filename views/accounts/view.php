<?php
    /* echo "<section>";
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
    echo "</section>"; */
?>
<section>
    <div class='panel-title'>
        <div></div>
        <h3>ACCOUNT</h3>
        <div></div>
    </div>
    <div class='result scroll'>
        <form>
            <article>
                <div class='platform'>
                    <img src='../img/platform/steam.png' alt='Logo Twitter'>
                    <h3>Steam:</h3>
                </div>
                <div class='basic-info'>
                    <div>
                        <b><u>Account</u>:</b>
                    </div>
                    <div>
                        <span>cuenta_de_Steam</span>
                    </div>
                </div>
            </article>
        </form>
    </div>
    </section>