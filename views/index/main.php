<section class="<?php echo $edited_successfully ? 'hidden' : ''; ?>">
    <div class="index-message scroll">
        <h2>Welcome <?php echo $_SESSION['user']['nick'] ?></h2>
        <h4>You has logged with <?php echo strtolower($_SESSION['user']['perfil']) ?> profile</h4>
        <?php
            if ($_SESSION['user']['perfil'] == 'ADMIN')
                include 'admin_message.php';
            elseif ($_SESSION['user']['perfil'] == 'USER')
                include 'user_message.php';
        ?>
    </div>
</section>