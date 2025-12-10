<?php
require_once("crud_operations.php");

if(!(isset($_SESSION["isSessionStarted"]))) {header("Location: log_in.php");}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
</head>
<body>

<form action="my_profile.php" method="POST">
<input type="submit" value="Mi perfil">
</form> 
<!-- SI ERES ADMIN TIENES EL BOTON DE ADMINISTRAR AQUI-->

<h1>LISTA DE USUARIOS</h1>
Buscar usuarios: <form action="" method="POST"> <!-- Formulario para buscar usuarios -->
<input type="text" name="search">
<input type="submit" value="Buscar">
</form>                        <!-- Fin formulario para buscar usuarios -->

<?php 
if(!isset($_POST["search"])){
    try{
        $filas = select("SELECT * FROM usuarios");
    }catch(PDOException $e){
        echo $e; 
    }if($filas->rowCount() >= 1){
        foreach($filas as $fila){?>
        <form action="my_profile.php" method="POST">
            <?php echo $fila["nombre"] ?>
            <input type="hidden" name="nombrecito" value='<?php echo $fila["nombre"]?>'>
            <input type="submit" value="ver perfil">
        </form>
    <?php }
     } 
}else{
    // HACER UN SELECT DE TODOS LOS USUARIOS CON EL VALOR DE $_POST["search"]
    try{
        $filas = select("SELECT * FROM usuarios WHERE nombre like '%$_POST[search]'");
    }catch(PDOException $e){
        echo $e; 
    }if($filas->rowCount() >= 1){
        foreach($filas as $fila){?>
        <form action="my_profile.php" method="POST">
            <?php echo $fila["nombre"] ?>
            <input type="hidden" name="nombrecito" value='<?php echo $fila["nombre"]?>'>
            <input type="submit" value="ver perfil">
        </form>
    <?php }
     }
}

?>
</body>
</html>