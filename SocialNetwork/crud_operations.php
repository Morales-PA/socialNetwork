<?php
    // THings to Know
    // CRUD operations 
    // Returns a PDOStatement object or false on failure. 

    // TODO:
    // Make it able to run as transactions
    // Make read fucntions throw exceptions

    function openConnectionToDB() {

        $cadena_conexion = 'mysql:dbname=redsocial;host=localhost';
        $usuario = 'root';
        $clave = '';
        
        // Is false accounted as an exception?
        $bd = new PDO($cadena_conexion, $usuario, $clave);

        //IMPORTATN: THIS CODE IS FOR A PERSONAL DOUBT
        // } catch (PDOException $e) {
        //     print($e);
        // } // finally {
        //     //Makinf finally blocks because false will not be counted as an exception
        // //}

        return $bd;
    }
    
    // Is exec really a better fit that query
    function createUpdateDelete($sqlQuery) {

        $dbConnection = openConnectionToDB();        

        $wasStatementSuccessful = $dbConnection->exec($sqlQuery);
        
        $dbConnection = null;

        return $wasStatementSuccessful;
    }

    function select($sqlQuery) {

        $dbConnection = openConnectionToDB();        

        $tempPdoObject = $dbConnection->query($sqlQuery);
        
        $dbConnection = null;

        return $tempPdoObject;
        
    }

// function select($sqlQuery, $params = []) {

//     $dbConnection = openConnectionToDB();

//     $stmt = $dbConnection->prepare($sqlQuery);
//     $stmt->execute($params);

//     return $stmt;  
// }

// $sql = "SELECT * FROM usuarios WHERE correo = ? AND contraseña = ?";
// $params = [$_POST['emailLogIn'], $_POST['passwordLogIn']];

// $filas = select($sql, $params);

// if ($filas->rowCount() == 1) {
//     // LOGIN OK
// } else {
//     // ERROR
// }
