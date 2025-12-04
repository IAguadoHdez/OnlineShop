<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';

// Obtenemos todos los productos
$result = mysqli_query($conn, "SELECT * FROM 002products");
$productos = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>