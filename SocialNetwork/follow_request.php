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
    
    <?php 

        try {
            $pendigFollowRequests = select("SELECT * FROM seguidores s INNER JOIN usuarios u ON s.idSeguidor = u.idUsuario;",[]);

        } catch (PDOException $e) {
            echo $e;
        }
        
        foreach ($pendigFollowRequests as $followRequest) {
           
            echo "<br>";
            echo $followRequest["nombre"]  . "quiere seguirte"; 
            echo "<br>";
            
        }

    
    ?>

</body>
</html>