<?php 
    session_start();
    require_once("crud_operations.php");
    if(!(isset($_SESSION["isSessionStarted"]))) { header("Location: log_in.php"); }
?>

<?php  
    if (isset($_POST["contentToPublish"])) {
        
        $tempString = $_POST["contentToPublish"];
        
        if (trim($tempString) != "" ) {
            createUpdateDelete("INSERT INTO posts (idUsuario,contenido) VALUES (?,?)",[$_SESSION["userInfo"][0],$_POST["contentToPublish"]]);
            header("Location: my_profile.php");
        } else {
            echo "No se puede publicar un post vacío";
        }
    
    } else {
        
    } 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Publicar Post</title>
    </head>
    <body>
        
        <h1>Crear Post</h1>

        <form action="" method="post">
            <input type="text" name="contentToPublish">
            <br>
            <input type="submit" value="Publicar">
        </form>
        <a href="my_profile.php">
                <button>Volver</button>
        </a>

    </body>
</html>