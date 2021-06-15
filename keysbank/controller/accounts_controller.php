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
            'idPlatform' => $_POST['subcategories'],
            'name_account' => dataClean($_POST['name']),
            'pass_account' => $_POST['pass'],
            'pass_date' => date('Y-m-d'),
            'url' => replaceCharacterByOtherCharacter( dataClean($_POST['url']), array(" ","'",'"',"&","|","<",">"), array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>") ),
            'info' => replaceCharacterByOtherCharacter( dataClean($_POST['info']), array(" ","'",'"',"&","|","<",">"), array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>") ),
            'notes' => replaceCharacterByOtherCharacter( dataClean($_POST['notes']), array(" ","'",'"',"&","|","<",">"), array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>") ),
        );
        $failuredAcount = $dataAccount['idCategory'] < 1 || $dataAccount['idCategory'] > $_SESSION['instance_platforms']->getTotalPlatformCategories();
        if (!$failuredAcount)
            $failuredAcount =  !validatePlatformSelected( $_SESSION['instance_platforms']->getPlatformsListByCategory($dataAccount['idCategory']), $dataAccount['idPlatform'] );
        if (!$failuredAcount) {
            $_SESSION['instance_accounts']->addAccount($dataAccount);
            $addedAcount = TRUE;
        }
    }
    elseif (isset($_POST['edit_account'])) {
        $dataAccount = array(
            'idUser' => $_SESSION['user']['id'],
            'idAccount' => $_GET['edit'],
            'idPlatform' => $_POST['subcategories'],
            'idCategory' => $_SESSION['instance_accounts']->getIdCategoryByAccount($_GET['edit']),
            'name_account' => $_POST['name'],
            'pass_account' => $_POST['pass'],
            'url' => replaceCharacterByOtherCharacter( dataClean($_POST['url']), array(" ","'",'"',"&","|","<",">"), array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>") ),
            'info' => replaceCharacterByOtherCharacter( dataClean($_POST['info']), array(" ","'",'"',"&","|","<",">"), array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>") ),
            'notes' => replaceCharacterByOtherCharacter( dataClean($_POST['notes']), array(" ","'",'"',"&","|","<",">"), array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>") ),
        );
        $failuredAcount =  !validatePlatformSelected($_SESSION['instance_platforms']->getPlatformsListByCategory($dataAccount['idCategory']),$dataAccount['idPlatform']);
        if (!$failuredAcount) {
            $_SESSION['instance_accounts']->updateAccount($dataAccount);
            $editedAcount = TRUE;
        }
    }
    elseif (isset($_GET['edit'])) {
        $dataAccount = $_SESSION['instance_accounts']->getAccountById($_SESSION['user']['id'],$_GET['edit']);
        if(!sizeof($dataAccount)) header('Location:./accounts.php');
        $platformListByCategory = $_SESSION['instance_platforms']->getPlatformsByCategory($dataAccount[0]['idCategory']);
    }
    elseif (isset($_GET['del'])) {
        $result_search = $_SESSION['instance_accounts']->getAccountById($_SESSION['user']['id'],$_GET['del']);
        if(!sizeof($result_search)) header('Location:./accounts.php');
    }
    elseif (isset($_POST['delete_account'])) {
        $_SESSION['instance_accounts']->deleteAccount($_SESSION['user']['id'],$_POST['id_account']);
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
    elseif (isset($_GET['edit'])) 
        include "../views/accounts/edit.php";
    elseif (isset($_GET['del'])) 
        include "../views/accounts/delete.php";
    elseif (isset($_GET['deleted'])) 
        include "../views/accounts/deleted.php";
    else 
        include "../views/accounts/main.php";


?>