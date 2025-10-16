<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_shop";

// Crear conexión a la base de datos
$connection = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión 
if ($connection->connect_error) {
    die("Failed Connection". $connection->connect_error);
}

mysqli_set_charset($connection,"utf8");
?>