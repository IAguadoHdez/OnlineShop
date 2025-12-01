<?php
// Permitir peticiones desde localhost
header('Access-Control-Allow-Origin: http://localhost:5500'); // Cambia el puerto si usas otro
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

include_once $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';

$q = isset($_GET['q']) ? $_GET['q'] : '';

if ($q !== "") {
    $q = strtolower($q);
    $stmt = $conn->prepare("SELECT * FROM 002products WHERE LOWER(product_name) LIKE ?");
    $likeQ = "%$q%";
    $stmt->bind_param("s", $likeQ);
} else {
    $stmt = $conn->prepare("SELECT * FROM 002products");
}

$stmt->execute();
$result = $stmt->get_result();
$productos = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();

// Devolver JSON
echo json_encode($productos);
?>
