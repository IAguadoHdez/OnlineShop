<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/functions/product_functions.php';

// Obtener el parámetro de búsqueda si existe
$q = isset($_GET['q']) ? $_GET['q'] : '';

// Preparar la consulta según si hay búsqueda o no
if ($q !== "") {
    $q = strtolower($q);
    $stmt = $conn->prepare("SELECT * FROM 002products WHERE LOWER(product_name) LIKE ?");
    $likeQ = "%$q%"; // cualquier parte del nombre
    $stmt->bind_param("s", $likeQ);
} else {
    $stmt = $conn->prepare("SELECT * FROM 002products");
}

// Ejecutar consulta
$stmt->execute();
$result = $stmt->get_result();
$productos = $result->fetch_all(MYSQLI_ASSOC);

// Mostrar resultados en HTML
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
