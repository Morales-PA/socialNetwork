<?php
session_start();
require_once("crud_operations.php");


if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!isset($_POST["newPassword"])){
        echo "No me ha llegado nada, vuelve a meterte desde el enlace del correo";
    }else{
        $salt = "impossibletoguess";
	    $passwordToHash = $_POST["newPassword"] . $salt;
	    $hashedPassword = password_hash($passwordToHash, PASSWORD_DEFAULT);
        createUpdateDelete("UPDATE usuarios SET contraseña = ? WHERE correo= ?", [$hashedPassword, $_SESSION["emailToChangePassword"]]);
        echo "contraseña cambiada con exito";
?>              <form action="log_in.php" method="POST"> 
                    <input type="submit" value="Ir a inicio de sesión">
                </form>
<?php   }
}else{

    if(isset($_GET["token"])){

        //Recorro todos los usuarios hasta encontrar el que tiene el parametro get hasheado
        $filas = select("SELECT * FROM usuarios WHERE 1=?", [1]);
        $salt = "impossibletoguess";

        foreach ($filas as $fila) {
            $expected = hash('sha256', $fila['correo'] . $salt);
            if ($_GET["token"] === $expected) {
?>
                <h3>Cambio de contraseña para el correo: <?php echo $fila["correo"]?></h3>
                <form action="write_new_password.php" method="POST">
                    Introduce tu nueva contraseña: 
                    <input type="text" name="newPassword">
                    <input type="submit" value="confirmar nueva contraseña">
                </form>
<?php 
                $_SESSION["emailToChangePassword"] = $fila["correo"];
            }
        }
    }else{
        echo "Falta el parametro get, no puedo saber quien eres";
    }

    if(!isset($_SESSION["emailToChangePassword"])){
        echo "No estas en la base de datos o el parametro get de la url no es correcto";
    }
}
?>
