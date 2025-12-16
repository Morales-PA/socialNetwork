<?php 
    session_start();
    require_once("crud_operations.php");

    if (!(isset($_SESSION["isSessionStarted"]))) { header("Location: log_in.php"); }

    if (isset($_POST["idPost"])) {
        $_SESSION["idPost"] = $_POST["idPost"];
        header("Location: view_post.php");
    }

    if (isset($_POST['comment'])) {

        try {
            $insertComment = select("INSERT INTO comentarios (idPost,idUsuario,fechaPublicacion,contenido) VALUES (?,?,NOW(),?)",[$_SESSION["idPost"],$_SESSION["userInfo"][0],$_SESSION["userInfo"][1] . " comentó: " . $_POST['comment']]);
            header("Location: view_post.php");
        } catch (PDOException $e) {
            echo $e;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver post</title>
</head>
<body>
    
    <a href="after_log_in_page.php">
        <button>Volver</button>
    </a>

    <?php  
        try {
            $post = select("SELECT * FROM posts WHERE idPost = ?",[$_SESSION["idPost"]]);
            $userPostComments = select("SELECT * FROM comentarios WHERE idPost = ?",[$_SESSION["idPost"]]);

        } catch (PDOException $e) {
            echo $e;
        }
        
        foreach ($post as $line) {

            echo "
            <article>
                <p><strong>Publicado el:</strong> {$line['fechaPublicacion']}</p>
                <p>{$line['contenido']}</p>
                <p><strong>Comentarios:</strong></p>
                <ul>
            ";

            if (count($userPostComments) > 0) {

                foreach ($userPostComments as $comment) {
                    echo "
                    <li>
                        <p>{$comment['contenido']}</p>
                        <small>{$comment['fechaPublicacion']}</small>
                    </li>
                    ";
                }
                
            } else {
                echo "<li>No hay comentarios</li>";
            }

            echo "</ul>";

            echo "
            <form method='POST' action=''>
                <textarea name='comment' placeholder='Escribe tu comentario...' required></textarea><br>
                <button type='submit'>Comentar</button>
            </form>";

            echo "<hr>";
        }
    ?>
</body>
</html>