<?php
    session_start();
    require_once("crud_operations.php");

    if (!(isset($_SESSION["isSessionStarted"]))) { header("Location: log_in.php"); }

    if (isset($_POST["idUsuario"],$_POST["nombre"],$_POST["correo"])) {

        $_SESSION["userToShow"] = [$_POST["idUsuario"],$_POST["nombre"],$_POST["correo"]];
        header("Location: other_profiles.php");
    }

        

    // Comprobar si el usuario solicita seguir.
        if (isset($_POST['isUserRequestingToFollow'])) {
                
            try {
                $existingFollow = select("SELECT * FROM seguidores WHERE idSeguidor = ? AND idSeguido = ? AND estado = 'pendiente'", [$_SESSION["userInfo"][0], $_SESSION["userToShow"][0]]);
            
            if (count($existingFollow) > 0) {
                echo "Ya has mandado tu solicitud de seguimiento.";
            } else {
                
                $insertFollowRequest = select("INSERT INTO seguidores (idSeguidor, idSeguido, estado) VALUES (?, ?, 'pendiente')", [$_SESSION["userInfo"][0], $_SESSION["userToShow"][0]]);
                echo "Solicitud mandada.";

            }
            } catch (PDOException $e) {
                echo $e;
            }
        }
    // Comprobar si el usuario solicita dejar seguir.
        if (isset($_POST["isUserRequestingToUnFollow"])) {
            
            try {
                $existingFollow = select("SELECT * FROM seguidores WHERE idSeguidor = ? AND idSeguido = ? AND estado = 'aceptado'", [$_SESSION["userInfo"][0], $_SESSION["userToShow"][0]]);
                
                if (count($existingFollow) > 0) {

                    $unfollow = select("DELETE FROM seguidores WHERE idSeguidor = ? AND idSeguido = ? AND estado = 'aceptado'", [$_SESSION["userInfo"][0], $_SESSION["userToShow"][0]]);
                    echo "Has dejado de seguir a este usuario.";            
                    header("Location: other_profiles.php");

                } else {
                    echo "No estás siguiendo a este usuario.";
                }
            } catch (PDOException $e) {
                echo $e;
            }
        }
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

    try {
        $isUserAFollower = select("SELECT * FROM seguidores WHERE idSeguidor = ? AND idSeguido = ? AND estado = 'aceptado'",[$_SESSION["userInfo"][0],$_SESSION["userToShow"][0]]);
    } catch (PDOException $e) {
        echo $e;
    }


    if (count($isUserAFollower) < 1) {
            echo "<h1>" . $_SESSION["userToShow"][1]  . "</h1>";
    ?>        
            <a href="after_log_in_page.php">
                <button>Volver</button>
            </a>
            <br>
            <form action="" method="POST">
                <input type="hidden" name="isUserRequestingToFollow" value="true">
                <input type="submit" value="Seguir a usuario">
            </form>
            <br>
            <br>
            <br>
            <br>
    <?php 
    
    } else {
            
            echo "<h1>" . $_SESSION["userToShow"][1]  . "</h1>";
    ?>
            <a href="after_log_in_page.php">
                <button>Volver</button>
            </a>
            <form action="" method="POST">
                <input type="hidden" name="isUserRequestingToUnFollow" value="true">
                <input type="submit" value="Dejar de seguir a usuario">
            </form>
            <br>
            <br>
            <br>
            <br>
    <?php 


        try {
            $userPosts = select("SELECT * FROM posts WHERE idUsuario = ? ORDER BY fechaPublicacion DESC",[$_SESSION["userToShow"][0]]);

        } catch (PDOException $e) {
            echo $e;
        }

        foreach ($userPosts as $post) { 
            
            try {
                $userPostComments = select("SELECT * FROM comentarios WHERE idPost = ?",[$post["idPost"]]);
                $amountOfComments = select("SELECT COUNT(*) FROM comentarios WHERE idPost = ?",[$post["idPost"]]);
                
            } catch (PDOException $e) {
                echo $e;
            }
            
            echo "
            <article>
                <p><strong>Publicado el:</strong> {$post['fechaPublicacion']}</p>

                <p>{$post['contenido']}</p>

                <p><strong>Número de comentarios:</strong> {$amountOfComments[0][0]}</p>
            </article>";
    ?>
                <form action="view_post.php" method="POST">
                        <input type="hidden" name="idPost" value="<?php echo $post["idPost"]; ?>">
                        <input type="submit" value="Ver post">
                    </form>

    <?php 
            echo "<hr>";
        }
    }
    ?>
  
    </body>
</html>