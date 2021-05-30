<!-- Mensajes o notificaciones destinadas a la vista principal del usuario -->
<?php 
    //Si la contraseña del admin es la contraseña por defecto y, el usuario tiene acceso, mostramos mensaje de error
    echo $_SESSION['insecure_app'] ? 
    "<p class='alert'>ERROR CODE (1): INSECURE APP. If you see this message, contact your administrator immediately. Until then, you will not be able to use the application.</p>" : ""; 
?>
<!-- <p>INSERT MESSAGE TO USER PROFILE</p> -->