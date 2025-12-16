<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar contraseña</title>
</head>
<body><?php

session_start();
use PHPMailer\PHPMailer\PHPMailer;
require_once("crud_operations.php");

if($_SERVER["REQUEST_METHOD"] == "GET"){
	header("Location: log_in.php");
}


// Validar que el campo del correo no esté vacío
    if (!isset($_POST["emailToRecoverPassword"])) {
		echo '<p style="color:red;">Asegurate de rellenar el campo del correo</p>';
    	echo '<form action="recover_password.php" method="POST">
            <input type="submit" value="Poner otra vez el correo">
          	</form>';
		exit();
    }else{
        $PasswordToRecoverEmail = trim($_POST["emailToRecoverPassword"]);
    }

// Comprobar que el email sea valido
if (!filter_var($PasswordToRecoverEmail, FILTER_VALIDATE_EMAIL)) {
	echo '<p style="color:red;">Has puesto un correo no válido, asegúrate de ponerlo bien</p>';
    echo '<form action="recover_password.php" method="POST">
            <input type="submit" value="Poner otra vez el correo">
          </form>';
		  exit();
}

try { //Comprobar que exista en la base de datos
   $filas = select("SELECT * FROM usuarios WHERE correo = ?" ,[$PasswordToRecoverEmail]);

    } catch (PDOException $e) {
        echo $e; 
    }

    if (count($filas) == 0) {
		echo '<p style="color:red;">No hay ninguna cuenta con este correo, asegúrate de ponerlo bien</p>';
    	echo '<form action="recover_password.php" method="POST">
            <input type="submit" value="Volver a poner el correo">
          </form>';
		  exit();
    }
?>
    <?php
 	require_once("Extensions/vendor/autoload.php"); //ubicacion del autoload
 	$mail = new PHPMailer();
 	$mail->isSMTP();
 	// cambiar a 0 para no ver mensajes de error
 	$mail->SMTPDebug  = 0; 							
 	$mail->SMTPAuth   = true;
 	$mail->SMTPSecure = "tls";                 
	$mail->Host = 'sandbox.smtp.mailtrap.io';  
	$mail->Port = 2525;
	$mail->CharSet = 'UTF-8';
	$mail->Encoding = 'base64';

	// introducir usuario de google
	$mail->Username   = "13e1f2d1098c7f"; 
	// introducir clave
	$mail->Password   = "d6e304757e882d";   	
	$mail->SetFrom('paginajuanyjaime@gmail.com', 'Juan y Jaime');
	// asunto
	$mail->Subject = "Correo para cambiar contraseña";
	// cuerpo
    $salt = "impossibletoguess";
	$token = hash('sha256', $PasswordToRecoverEmail . $salt);
	$mail->MsgHTML("Te hemos mandado este correo porque has solicitado cambiar tu contraseña:<br><br>
	<a href='http://localhost/SocialNetwork/write_new_password.php?token=$token'>Cambiar contraseña</a>");
	// adjuntos 
	// $mail->addAttachment("");
	// destinatario
	$address = $PasswordToRecoverEmail;
	$mail->AddAddress($address);
	// enviar
	$resul = $mail->Send();
	if(!$resul) {
	  echo "Error" . $mail->ErrorInfo;
	} else {
	  echo "Te hemos enviado un correo, revisalo para cambiar la contraseña";
	  echo '<form action="log_in.php" method="POST">
            <input type="submit" value="Ir al login">
          </form>';
	}
 ?>
</body>
</html>