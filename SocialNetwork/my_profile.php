<?php if($_SERVER["REQUEST_METHOD"] == "POST"){?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
</head>
<body>

    <!-- HACER UN SELECT PARA MOSTRAR EL NOMBRE -->
    <h1>Jaime Alonso</h1>

    <form action="write_post.php" method="POST">
    <input type="submit" value="Crear post">
    </form>

    <h3>TUS POSTS:</h3>
    <!-- Hacer select de tus posts ordenados por fecha de publicacion -->
    
</body>
</html>


<?php }else{
    header("Location: log_in.php");
}?>