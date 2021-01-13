<?php
    // ACTIONS CONTROLLER \\
    $result_search = array();
    $emptyList = FALSE;
    
    
    if (isset($_GET['view'])) 
        $result_search = $_SESSION['instance_accounts']->getAccountById($_SESSION['user']['id'],$_GET['view']);
    else {
        if (isset($_POST['search_account'])) 
            $result_search = $_SESSION['instance_accounts']->getUserAccounts( $_SESSION['user']['id'],strtolower( dataClean($_POST['input_search']) ) );
        else {
            $result_search = $_SESSION['instance_accounts']->getUserAccounts($_SESSION['user']['id'],'');
            $emptyList = !sizeof($result_search);
        }
    }

    //  VIEWS  \\
    if (isset($_GET['add'])) {
        
    }
    elseif (isset($_GET['view'])) 
        include "../views/accounts/view.php";
    elseif (isset($_GET['edit'])) {
        
    }
    else 
        include "../views/accounts/main.php";


?>