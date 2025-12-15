<?php
    session_start();
    require_once("crud_operations.php");
    if(!(isset($_SESSION["isSessionStarted"]))) { header("Location: log_in.php"); }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes</title>
</head>
<body>

    <a href="my_profile.php">
        <button>Volver</button>
    </a>

    <?php  
        if (isset($_POST["follower"],$_POST["followed"])) {
            createUpdateDelete("UPDATE seguidores SET estado = 'aceptado' WHERE idSeguidor = ? AND idSeguido = ?",[$_POST["follower"],$_POST["followed"]]);
            header("Location: follow_request.php");
        }
    ?>

    <?php 
        // SHOW THE FOLLOWERS REQUESTING THE USER.
        try {
            $pendigFollowRequests = select("SELECT * FROM seguidores s INNER JOIN usuarios u ON s.idSeguidor = u.idUsuario WHERE s.idSeguido = ? AND estado = 'pendiente';",[$_SESSION["userInfo"][0]]);

        } catch (PDOException $e) {
            echo $e;
        }
        
        foreach ($pendigFollowRequests as $followRequest) {
    ?>       
            
        <form action="" method="post">
            <?php echo $followRequest["nombre"] . " quiere seguirte." ?>              
            <input type="hidden" name="follower" value="<?php echo $followRequest["idSeguidor"] ?>">
            <input type="hidden" name="followed" value="<?php echo $followRequest["idSeguido"] ?>">
            <input type="submit" value="Aceptar">
        </form>  
        <hr>
            
    <?php         
        }
    ?>
    
    

</body>
</html>