<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/functions/product_functions.php';

// Reviso que exista la q en la URL, si existe lo guardo en la variable q y si no lo dejo vacio
$q = isset($_GET['q']) ? $_GET['q'] : '';

// Si q no esta vacio creamos la consulta para empezar a buscar
if ($q !== "") {
    // Convertimos $q a minúsculas
    $q = strtolower($q);

    // Preparar la consulta usando LIKE con minúsculas
    $stmt = $conn->prepare("SELECT * FROM 002products WHERE LOWER(product_name) LIKE ?");
    
    // $likeQ significa que cualquier producto que contenga cierta 
    // parte de una palabra, por ejemplo buscamos sobre "camiseta"
    // mientras tuviese puesto "%camisa%" encontraría tanto "Camisas" como "Camisetas"
    $likeQ = "$q%";

    $stmt->bind_param("s", $likeQ);
} else {
    // Si no hay búsqueda, mostramos todos los productos
    $stmt = $conn->prepare("SELECT * FROM 002products");
}

// Ejecutar la consulta
$stmt->execute();
$result = $stmt->get_result();
$productos = $result->fetch_all(MYSQLI_ASSOC);

// Mostrar resultados
if (count($productos) > 0) {
    foreach ($productos as $p) {
        showProducts($p);
    }
} else {
    echo "<p class='text-texto'>No se encontraron productos.</p>";
}

$stmt->close();
$conn->close();
?>
