
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Email</title>
</head>
<body><?php
// TODO: 
// Control user in search mode
session_start();
use PHPMailer\PHPMailer\PHPMailer;
require_once("crud_operations.php");

if($_SERVER["REQUEST_METHOD"] == "GET"){
	header("Location: log_in.php");
}

// Validar que existan y no estén vacíos
$required = ["registerEmail", "registerName", "registerPassword"];
foreach ($required as $field) {
    if (!isset($_POST[$field]) || trim($_POST[$field]) === "") {
		echo '<p style="color:red;">Asegurate de rellenar los 3 campos</p>';
    	echo '<form action="register.php" method="POST">
            <input type="submit" value="Volver a intentar registrarse">
          	</form>';
		exit();
    }
}

// Comprobar que el email sea valido
if (!filter_var($_POST["registerEmail"], FILTER_VALIDATE_EMAIL)) {
	echo '<p style="color:red;">Ese correo no vale, pon uno valido</p>';
    echo '<form action="register.php" method="POST">
            <input type="submit" value="Volver a intentar registrarse">
          </form>';
		  exit();
}

$registerEmail = trim($_POST["registerEmail"]);
$registerName = trim($_POST["registerName"]);
$registerPassword = trim($_POST["registerPassword"]);

try { //Comprobar que no exista ya ese correo registrado
   $filas = select("SELECT * FROM usuarios WHERE correo = ?" ,[$registerEmail]);

    } catch (PDOException $e) {
        echo $e; 
    }

    if (count($filas) == 1) {
		echo '<p style="color:red;">Ya estas registrado con este correo, tienes que iniciar sesión</p>';
    	echo '<form action="register.php" method="POST">
            <input type="submit" value="Volver a intentar registrarse">
          </form>';
		  exit();
    }

try { //Comprobar que no exista ese nombre de usuario
   $filas = select("SELECT * FROM usuarios WHERE nombre = ?" ,[$registerName]);

    } catch (PDOException $e) {
        echo $e; 
    }

    if (count($filas) == 1) {
	   	echo '<p style="color:red;">Ese nombre de usuario ya está en uso, pon otro</p>';
    	echo '<form action="register.php" method="POST">
            <input type="submit" value="Volver a intentar registrarse">
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
	$mail->Subject = "Correo para confirmar registro";
	// cuerpo
	$mail->MsgHTML("Confirmar registro aqui \n\n <a href:'http://localhost/SocialNetwork/confirm_account.php'>Confirmar registro</a>");
	// adjuntos
	// $mail->addAttachment("");
	// destinatario
	$address = $registerEmail;
	$mail->AddAddress($address, $registerName);
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