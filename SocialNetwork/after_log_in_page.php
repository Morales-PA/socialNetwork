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
        <title>Usuarios</title>
    </head>

    <body>
        
        <a href="my_profile.php">
          <button>Ir a perfil</button>
        </a>

        <!-- SI ERES ADMIN TIENES EL BOTON DE ADMINISTRAR AQUI-->
        
        <!-- // TOFIX: Is it really safer to use files instedad of method which are their benefits -->
        <a href="session_destroy.php">
          <button>Cerrar sesión</button>
        </a> 

        <h1>LISTA DE USUARIOS</h1>
        Buscar usuarios: 
        <form action="" method="POST"> <!-- Formulario para buscar usuarios -->
            <input type="text" name="search">
            <input type="submit" value="Buscar">
        </form>                        <!-- Fin formulario para buscar usuarios -->
        
        <?php 

        if (!isset($_POST["search"])) {

            try {
                $filas = select("SELECT * FROM usuarios WHERE activo = 1",[]); // FIX: Prepared statements ALWAYS require a tag

            } catch (PDOException $e) {
                echo $e; 
            } 
            
            if (count($filas) >= 1) {

                foreach($filas as $fila) {

                    if($fila["nombre"] == $_SESSION["userInfo"][1]) { continue; } //me salto mi propio usuario
        ?>      
                    <form action="other_profiles.php" method="POST">
                    <?php echo $fila["nombre"]; ?>
                        <input type="hidden" name="idUsuario" value="<?php echo $fila['idUsuario']; ?>">
                        <input type="hidden" name="nombre" value="<?php echo $fila['nombre']; ?>">
                        <input type="hidden" name="correo" value="<?php echo $fila['correo']; ?>">
                        <input type="submit" value="ver perfil">
                    </form>

        <?php 
                }
            }

        } else {

            try {
                $filas = select("SELECT * FROM usuarios WHERE nombre LIKE ?", ['%' . $_POST["search"] . '%']);

            } catch (PDOException $e) {
                echo $e; 
            } 
            
            if (count($filas) >= 1) {

                foreach($filas as $fila) {

                    if($fila["nombre"] == $_SESSION["userInfo"][1]) { continue; } 
        ?>  
                    <form action="other_profiles.php" method="POST">
                        <?php echo $fila["nombre"]; ?>
                        <input type="hidden" name="idUsuario" value="<?php echo $fila['idUsuario']; ?>">
                        <input type="hidden" name="nombre" value="<?php echo $fila['nombre']; ?>">
                        <input type="hidden" name="correo" value="<?php echo $fila['correo']; ?>">
                        <input type="submit" value="ver perfil">
                    </form>

        <?php 
                }

            } else {
                echo "No hay usuarios que coincidan con la búsqueda.";
            }
        }

        ?>
    </body>
</html>