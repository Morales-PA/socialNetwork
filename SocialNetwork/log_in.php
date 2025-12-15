<!-- To fix: hay que conseguir que un usuario pueda iniciar sesion y le redirija al after_log_in_page.php 
-->

<?php
//       ' OR 1=1 LIMIT 1 #
session_start();
require_once("crud_operations.php");

if (isset($_SESSION["isSessionStarted"])) { //comprobar si la sesion esta iniciada, si lo está, redirigir al afterlogin.php 
    header("Location: after_log_in_page.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST["emailLogIn"],$_POST["passwordLogIn"])){
        
        try {
            $filas = select("SELECT * FROM usuarios WHERE correo = ? AND activo = 1",[$_POST["emailLogIn"]]);

        } catch (PDOException $e) {
            echo $e; 
        }

        if (count($filas) == 1) {

            foreach($filas as $fila) {
                
                $salt = "impossibletoguess";
                if (password_verify($_POST["passwordLogIn"] . $salt, $fila["contraseña"])) {

                    $_SESSION["userInfo"] = [$fila["idUsuario"],$fila["nombre"],$fila["correo"]];
                    $_SESSION["isSessionStarted"] = true;
                    header("Location: after_log_in_page.php");     
                    
                }
                
            }

        } else {
            header("Location: log_in.php");
        }
    }
    }
?>

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

    <form action="recover_password.php" method="POST"> <!-- Formulario recuperar contraseña -->
        <input type="submit" value="He olvidado mi contraseña">
    </form><br>                             <!-- Fin formulario recuperar contraseña -->

     <h3>¿No tienes cuenta? Registrate Aquí⬇⬇</h3>   <!-- Formulario registrarse -->
    <form action="register.php" method="POST">
        <input type="submit" value="Registrarse">
    </form>                                         <!-- Fin formulario registrarse -->

</body>
</html>