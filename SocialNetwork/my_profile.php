<!-- TO DO: Hacer el select de los post por fecha de publicacion(hacer donde el comentario de abajo)-->

<?php 
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    header("Location: my_profile.php");
}

if(isset($_SESSION["isSessionStarted"]) && $_SESSION["isSessionStarted"] == true){

    require_once("crud_operations.php");
?>
    <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
</head>
<body>

    <?php
    
    if(isset($_POST["nombrecito"])){ //Para sacar el nombre del perfil que estas visitando, si es el de otro saco su nombre
        ?><h1><?php    
        echo $_POST["nombrecito"]; ?> </h1><?php
    
    }else{
        ?><h1><?php    
        echo "Estás en tu perfil, " . $_SESSION["whoami"];?></h1> <!-- Si visitas tu usuario ves tu nombre y puedes añadir un post-->
        <form action="write_post.php" method="POST">
        <input type="submit" value="Crear post">
        </form>
        <?php }?>

    <h3>POSTS:</h3>
    <!-- Hacer select de tus posts ordenados por fecha de publicacion -->
    
</body>
</html>

<?php }else{
    header("Location: log_in.php");
} ?>

