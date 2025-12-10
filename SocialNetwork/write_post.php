<?php if($_SERVER["REQUEST_METHOD"] == "POST"){?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escribir post</title>
</head>
<body>
    Escribe el contenido del post:
    <form action="publish_post.php" method="Post">
    <textarea id="comentario" name="comment" rows="5" cols="40"></textarea><br><br>
    <button type="submit">Publicar post</button>
</form>

    </form>

</body>
</html>

<?php }else{
    header("Location: log_in.php");
}?>