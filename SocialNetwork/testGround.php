<?php 
    // Can´t use placholders for databases

    require_once("crud_operations.php");

    $params = ["usuarios"];
    
    $myQuery = select("SELECT nombre FROM ?",$params);

    foreach ($myQuery as $key) {
        echo $key["nombre"];
    }