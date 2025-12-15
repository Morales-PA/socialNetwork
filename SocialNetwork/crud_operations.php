<?php
    // TODO:
    // Make it able to run as transactions

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
    function createUpdateDelete($sqlQuery,$params) {

        $dbConnection = openConnectionToDB();        

        $tempPdoObject = $dbConnection->prepare($sqlQuery);
        $tempPdoObject->execute($params);

        $dbConnection = null;

    }

    function select($sqlQuery,$params) {
        
        $dbConnection = openConnectionToDB();        

        $tempPdoObject = $dbConnection->prepare($sqlQuery);
        $tempPdoObject->execute($params);
        $resultSet = $tempPdoObject->fetchAll();

        $dbConnection = null;

        return $resultSet; 
    }