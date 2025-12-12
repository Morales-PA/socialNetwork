<?php 

// TODO: 
// Control user in search mode
session_start();
require_once("crud_operations.php");
if(!(isset($_SESSION["isSessionStarted"]))) { header("Location: log_in.php"); }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
</head>
<body>
    <h1>REGISTRARSE / CREAR CUENTA</h1>         
    <form action="send_email.php" mehtod="POST">   <!-- Crear cuenta con estos datos -->
        Correo: <input type="text"><br><br>
        Nombre de Usuario: <input type="text"><br><br>
        Contraseña: <input type="text"><br><br>
        <input type="submit" value="Crear cuenta con estos datos">
    </form>
</body>
</html>