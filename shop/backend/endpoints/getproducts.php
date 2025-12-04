<?php
header('Content-Type: application/json');

include_once $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';

// Obtener parámetro de búsqueda
$q = isset($_GET['q']) ? $_GET['q'] : '';

// Preparar la consulta
if ($q !== "") {
    $q = strtolower($q);
    $stmt = $conn->prepare("SELECT * FROM 002products WHERE LOWER(product_name) LIKE ?");
    $likeQ = "%$q%";
    $stmt->bind_param("s", $likeQ);
} else {
    $stmt = $conn->prepare("SELECT * FROM 002products");
}

// Ejecutar
$stmt->execute();
$result = $stmt->get_result();
$productos = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();

// Devolver JSON
echo json_encode($productos);
exit;
?>
