<?php 

// TODO: 
// Control user in search mode
session_start();
require_once("crud_operations.php");
if ($_SERVER["REQUEST_METHOD"] == "GET"){header("Location: log_in.php");}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar contraseña</title>
</head>
<body>
    <form action="email_to_recover_password.php" method="POST">
        Introduce tu correo para cambiar la contraseña: 
        <input type="text" name="emailToRecoverPassword">
        <input type="submit">
    </form>    


</body>
</html>