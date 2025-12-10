<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
</head>
<body>
    <h1>Log in</h1> 

    <!-- Formulario Login -->
    <form action="AfterLogInPage.php" method="POST">  
        Email: <input type="text" name="emailLogIn">
        <br>
        Contraseña: <input type="password" name="passwordLogIn"> <br>
        <input type="submit" value="Iniciar">
    </form>                    
    <!-- Fin formulario Login -->

    <!-- Formulario recuperar contraseña -->
    <form action="RecoverPassword.php" method="POST"> 
        <input type="submit" value="Recuperar Contraseña">
    </form><br>                             
    <!-- Fin formulario recuperar contraseña -->

    <!-- Formulario registrarse -->
     <h3>Registrar si no tienes contraseña</h3>   
    <form action="Register.php" method="POST">
        <input type="submit" value="Registrarse">
    </form>
    <!-- Fin formulario registrarse -->

</body>
</html>