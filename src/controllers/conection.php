<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "hatters_db";

// Conexión
$connection = mysqli_connect($host, $user, $password, $database);

// Validar conexión
if($connection -> connect_error){
    die("Error de conexión: " . $connection -> connect_error);
}

?>