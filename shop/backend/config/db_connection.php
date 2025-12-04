<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_shop";

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión 
if ($conn->connect_error) {
    die("Failed Connection" . $conn->connect_error);
}

mysqli_set_charset($conn, "utf8");

?>