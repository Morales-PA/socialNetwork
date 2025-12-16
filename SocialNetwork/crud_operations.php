<?php

    function openConnectionToDB() {

        $cadena_conexion = 'mysql:dbname=redsocial;host=localhost';
        $usuario = 'root';
        $clave = '';
        
        $bd = new PDO($cadena_conexion, $usuario, $clave);

        return $bd;
    }
    
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