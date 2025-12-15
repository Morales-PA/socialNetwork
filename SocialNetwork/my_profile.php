<?php
    session_start();
    require_once("crud_operations.php");
    if (!(isset($_SESSION["isSessionStarted"]))) { header("Location: log_in.php"); }
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
            echo "<h1>" . $_SESSION["userInfo"][1]  . "</h1>";
    ?>        
            <a href="publish_post.php">
                <button>Publicar post</button>
            </a>
            <br>
            <a href="after_log_in_page.php">
                <button>Volver</button>
            </a>
            <br>
            <a href="follow_request.php">
                <button>Solicitudes</button>
            </a>
            <br>
            <br>
            <br>

    <?php 
        
        try {
            $userPosts = select("SELECT * FROM posts WHERE idUsuario = ? ORDER BY fechaPublicacion DESC",[$_SESSION["userInfo"][0]]);

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
    ?>
  
    </body>
</html>