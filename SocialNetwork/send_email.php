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
    <title>Enviar Email</title>
</head>
<body>
    

    <?php // HAY QUE MIRAR LA PAGINA ENTERA ?>
    

    <?php 	
 	// use PHPMailer\PHPMailer\PHPMailer;
 	require "Extensions/autoload.php"; //ubicacion del autoload
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
	$mail->SetFrom('user@gmail.com', 'Test');
	// asunto
	$mail->Subject    = "Correo de prueba";
	// cuerpo
	$mail->MsgHTML('Prueba');
	// adjuntos
	$mail->addAttachment("empleado.xsd");
	// destinatario
	$address = "jaimeacicuendez@gmail.com";
	$mail->AddAddress($address, "Test");
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