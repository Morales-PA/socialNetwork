<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesion</title>
</head>
<body>
    <h1>INICIO DE SESION</h1> 
    <form action="after_log_in_page.php" method="POST">  <!-- Formulario Login -->
        Correo: <input type="text" name="emailLogIn">
        Contraseña: <input type="password" name="passwordLogIn"> <br>
        <input type="submit" value="Iniciar">
    </form>                    <!-- Fin formulario Login -->

    <form action="recover_password.php" method="POST"> <!-- Formulario recuperar contraseña -->
        <input type="submit" value="Recuperar contraseña">
    </form><br>                             <!-- Fin formulario recuperar contraseña -->

    <?php
    //Cuando no exista el usuario y contraseña en la base de datos te redirige aquí
    // y muestra un mensaje de: "El usuario o la contraseña son incorrectos"
    ?>

     <h3>¿No tienes cuenta? Registrate Aquí⬇⬇</h3>   <!-- Formulario registrarse -->
    <form action="register.php" method="POST">
        <input type="submit" value="Registrarse">
    </form>                                         <!-- Fin formulario registrarse -->

</body>
</html>