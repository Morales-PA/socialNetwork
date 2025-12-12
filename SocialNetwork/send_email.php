<?php
// TODO: 
// Control user in search mode
session_start();
use PHPMailer\PHPMailer\PHPMailer;
require_once("crud_operations.php");

if($_SERVER["REQUEST_METHOD"] == "GET"){
	header("Location: log_in.php");
}

if(isset($_POST["registerEmail"]) && isset($_POST["registerName"]) && isset($_POST["registerPassword"]) ) {
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Email</title>
</head>
<body>
    <?php
 	require_once("C:/xampp/htdocs/TurnoMañana/SocialNetwork/Extensions/vendor/autoload.php"); //ubicacion del autoload
 	$mail = new PHPMailer();
 	$mail->isSMTP();
 	// cambiar a 0 para no ver mensajes de error
 	$mail->SMTPDebug  = 0; 							
 	$mail->SMTPAuth   = true;
 	$mail->SMTPSecure = "tls";                 
	$mail->Host = 'sandbox.smtp.mailtrap.io';  
	$mail->Port = 2525;

	// introducir usuario de google
	$mail->Username   = "13e1f2d1098c7f"; 
	// introducir clave
	$mail->Password   = "d6e304757e882d";   	
	$mail->SetFrom('paginajuanyjaime@gmail.com', 'Juan y Jaime');
	// asunto
	$mail->Subject = "Correo para confirmar registro con contraseña" . $_POST["registerPassword"];
	// cuerpo
	$mail->MsgHTML("Confirmar registro aqui \n\n http://localhost/TurnoMa%c3%b1ana/SocialNetwork/confirm_account.php");
	// adjuntos
	// $mail->addAttachment("");
	// destinatario
	$address = $_POST["registerEmail"];
	$mail->AddAddress($address, $_POST["registerName"]);
	// enviar
	$resul = $mail->Send();
	if(!$resul) {
	  echo "Error" . $mail->ErrorInfo;
	} else {
	  echo "Enviado";
	}

    ?>




</body>
</html>
<?php } 
?>

