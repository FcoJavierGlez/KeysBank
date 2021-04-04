<?php
    // ACTIONS CONTROLLER \\
    $result_search = array();
    $dataAccount = array();
    $emptyList = FALSE;
    $addedAcount = FALSE;
    
    
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
    if (isset($_POST['add_account'])) {
        $dataAccount = array(
            'idUser' => $_SESSION['user']['id'],
            'idCategory' => $_POST['categories'],
            'name_account' => dataClean($_POST['name']),
            'pass_account' => $_POST['pass'],
            'name_platform' => $_POST['subcategories'],
            'url' => dataClean($_POST['url']),
            'info' => dataClean($_POST['info']),
            'notes' => dataClean($_POST['notes']),
        );
        $_SESSION['instance_accounts']->setPassAccount($dataAccount);
        $addedAcount = TRUE;
    }

    //  VIEWS  \\
    if (isset($_GET['add'])) 
        include "../views/accounts/add.php";
    elseif (isset($_GET['view'])) 
        include "../views/accounts/view.php";
    elseif (isset($_GET['edit'])) {
        
    }
    else 
        include "../views/accounts/main.php";


?>