<form action="index.php" method="POST" class="form_login">
    <input type="text" name="nick" placeholder="nick" class="<?php echo inputStyle($errorLogin,$loggedNow); ?>" 
            value="<?php echo (isset($_POST['nick']) ? dataClean($_POST['nick']) : ''); ?>">
    <input type="password" name="pswd" placeholder="password" class="<?php echo inputStyle($errorLogin,$loggedNow); ?>">
    <span class="text-error"><?php echo ($errorLogin && !($userPending || $userBanned) ? 'Username or password invalid' : ''); ?></span>
    <span class="text-error"><?php echo ($userPending ? 'Account pending to be activated' : ''); ?></span>
    <span class="text-error"><?php echo ($userBanned ? 'Your account has been banned' : ''); ?></span>
    <input type="submit" name="login" value="Enter" class="">
    <div><a href="index.php?register" class="register">Register now</a></div>
</form>