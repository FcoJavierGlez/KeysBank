<?php
    $user_nav = array(
        array(
            'name' => 'Accounts',
            'url' => 'accounts.php'
        ),
        array(
            'name' => 'Profile',
            'url' => 'profile.php'
        ),
    );
    $admin_nav = array(
        array(
            'name' => 'Users',
            'url' => 'users.php'
        ),
        array(
            'name' => 'Platforms',
            'url' => 'platforms.php'
        ),
        array(
            'name' => 'Profile',
            'url' => 'profile.php'
        ),
    );
    
    if (!($_SESSION['user']['perfil'] == 'INVITED' || $_SESSION['user']['current_state'] !== 'ACTIVE')) {
        echo "<ul>";
        echo "<li><a href='".(preg_match('/\/pages\//', $_SERVER['PHP_SELF']) ? '../index.php' : 'index.php')."'>Home</a></li>";
        if ($_SESSION['user']['perfil'] == 'ADMIN') 
            foreach ($admin_nav as $value)
                echo "<li><a href='".(preg_match('/\/pages\//', $_SERVER['PHP_SELF']) ? $value['url'] : 'pages/'.$value['url'])."'>".$value['name']."</a></li>";
        else
            foreach ($user_nav as $value)
                echo "<li><a href='".(preg_match('/\/pages\//', $_SERVER['PHP_SELF']) ? $value['url'] : 'pages/'.$value['url'])."'>".$value['name']."</a></li>";
        echo "</ul>";

    }

?>