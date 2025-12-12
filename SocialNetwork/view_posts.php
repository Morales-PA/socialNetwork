<?php 

// TODO: 
// Control user in search mode
session_start();
require_once("crud_operations.php");
if(!(isset($_SESSION["isSessionStarted"]))) { header("Location: log_in.php"); }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Posts</title>
</head>
<body>
    
</body>
</html>