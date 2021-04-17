<?php
    // ACTIONS CONTROLLER \\
    $result_search = array();
    $dataAccount = array();
    $platformListByCategory = array();

    $emptyList = FALSE;
    $addedAcount = FALSE;
    $editedAcount = FALSE;
    $failuredAcount = FALSE;
    
    if (isset($_POST['add_account'])) {
        $dataAccount = array(
            'idUser' => $_SESSION['user']['id'],
            'idCategory' => $_POST['categories'],
            'name_account' => dataClean($_POST['name']),
            'pass_account' => $_POST['pass'],
            'pass_date' => date('Y-m-d'),
            'name_platform' => $_POST['subcategories'],
            'url' => dataClean($_POST['url']),
            'info' => dataClean($_POST['info']),
            'notes' => dataClean($_POST['notes']),
        );
        $failuredAcount = $dataAccount['idCategory'] < 1 || $dataAccount['idCategory'] > $_SESSION['instance_platforms']->getTotalPlatformCategories();
        if (!$failuredAcount)
            $failuredAcount =  !validatePlatformSelected($_SESSION['instance_platforms']->getPlatformsListByCategory($dataAccount['idCategory']),$dataAccount['name_platform']);
        if (!$failuredAcount) {
            $_SESSION['instance_accounts']->setPassAccount($dataAccount);
            $addedAcount = TRUE;
        }
    }
    elseif (isset($_POST['edit_account'])) {
        $dataAccount = array(
            'idUser' => $_SESSION['user']['id'],
            'idAccount' => $_GET['edit'],
            'idCategory' => $_SESSION['instance_accounts']->getIdCategoryByAccount($_GET['edit']),
            'name_account' => $_POST['name'],
            'pass_account' => $_POST['pass'],
            'name_platform' => $_POST['subcategories'],
            'url' => dataClean($_POST['url']),
            'info' => dataClean($_POST['info']),
            'notes' => dataClean($_POST['notes']),
        );
        $failuredAcount =  !validatePlatformSelected($_SESSION['instance_platforms']->getPlatformsListByCategory($dataAccount['idCategory']),$dataAccount['name_platform']);
        if (!$failuredAcount) {
            /* echo "<pre>";
                print_r($dataAccount);
            echo "</pre>"; */
            $_SESSION['instance_accounts']->updateAccount($dataAccount);
            $editedAcount = TRUE;
        }
    }
    elseif (isset($_GET['edit'])) {
        $dataAccount = $_SESSION['instance_accounts']->getAccountById($_SESSION['user']['id'],$_GET['edit']);
        if(!sizeof($dataAccount)) header('Location:./accounts.php');
        $platformListByCategory = $_SESSION['instance_platforms']->getPlatformsByCategory($dataAccount[0]['idCategory']);
    }
    elseif (isset($_POST['delete_account'])) {
        $_SESSION['instance_accounts']->deleteAccountById($_SESSION['user']['id'],$_POST['id_account']);
    }
    elseif (isset($_GET['view'])) {
        $result_search = $_SESSION['instance_accounts']->getAccountById($_SESSION['user']['id'],$_GET['view']);
        if(!sizeof($result_search)) header('Location:./accounts.php');
    }
    else {
        if (isset($_POST['search_account'])) 
            $result_search = $_SESSION['instance_accounts']->getUserAccounts( $_SESSION['user']['id'],strtolower( dataClean($_POST['input_search']) ) );
        else {
            $result_search = $_SESSION['instance_accounts']->getUserAccounts($_SESSION['user']['id'],'');
            $emptyList = !sizeof($result_search);
        }
    }
    

    //  VIEWS  \\
    if (isset($_GET['add'])) 
        include "../views/accounts/add.php";
    elseif (isset($_GET['view'])) 
        include "../views/accounts/view.php";
    elseif (isset($_GET['edit'])) {
        include "../views/accounts/edit.php";
        /* echo "<pre>";
            print_r($dataAccount);
        echo "</pre>"; */
        /* echo "<pre>";
            print_r($platformListByCategory);
        echo "</pre>"; */
    }
    elseif (isset($_GET['del'])) 
        include "../views/accounts/delete.php";
    elseif (isset($_GET['deleted'])) 
        include "../views/accounts/deleted.php";
    else 
        include "../views/accounts/main.php";


?>