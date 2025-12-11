<?php if($_SERVER["REQUEST_METHOD"] == "GET"){header("Location: log_in.php"); }?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
</head>
<body>

    <h1><?php session_start(); 
    
    if(isset($_POST["nombrecito"])){ //Para sacar el nombre del perfil que estas visitando
        echo $_POST["nombrecito"];
    }else{
        echo "Estás en tu perfil, " . $_SESSION["whoami"];
        }?></h1>

    <form action="write_post.php" method="POST">
    <input type="submit" value="Crear post">
    </form>

    <h3>TUS POSTS:</h3>
    <!-- Hacer select de tus posts ordenados por fecha de publicacion -->
    
</body>
</html>