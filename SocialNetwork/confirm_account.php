<?php
session_start();
require_once("crud_operations.php");
if(isset($_GET["token"])){

    //Recorro todos los usuarios hasta encontrar el que tiene el parametro get hasheado
    $filas = select("SELECT * FROM usuarios WHERE 1=?", [1]);
    $salt = "impossibletoguess";

    foreach ($filas as $fila) {
        $expected = hash('sha256', $fila['correo'] . $salt);
        if ($_GET["token"] === $expected) {
            createUpdateDelete("UPDATE usuarios SET activo = 1 WHERE correo=?", [$fila["correo"]]);
            echo "Cuenta activada correctamente.";
            $_SESSION["isAccountConfirm"] = true;
        }
    }
}else{
    echo "Falta el parametro get, no puedo saber quien eres";
}

if(isset($_SESSION["isAccountConfirm"])){
    session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Te has registrado</title>
</head>
<body>
    <form action="log_in.php" method="POST">
        <input type="submit" value="Ir a inicio de sesion">
    </form>
</body>
</html>
<?php }else{
    echo "No estas en la base de datos o el parametro get de la url no es correcto";
}?>