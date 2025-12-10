<!-- To fix: hay que conseguir que un usuario pueda iniciar sesion y le redirija al after_log_in_page.php 
-->


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesion</title>
</head>
<body>
    <h1>INICIO DE SESION</h1> 
    <form action="" method="POST">  <!-- Formulario Login -->
        Correo: <input type="text" name="emailLogIn">
        Contraseña: <input type="password" name="passwordLogIn"> <br>
        <input type="submit" value="Iniciar">
    </form>                    <!-- Fin formulario Login -->

<?php
    require_once("crud_operations.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        try{
            $filas = select("SELECT * FROM usuarios WHERE correo='$_POST[emailLogIn]' AND contraseña='$_POST[passwordLogIn]'");
        }catch(PDOException $e){
            echo $e; 
        }
        var_dump($filas);    
        if($filas->rowCount() == 1){
            $_SESSION["isSessionStarted"] = true;
            header("Location: after_log_in_page.php");
        }else{
            header("Location: log_in.php");
        }
    }
    
?>


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