<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');

include_once $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';

// Obtener búsqueda
$q = isset($_GET['q']) ? $_GET['q'] : '';

// Preparar consulta
if ($q !== "") {
    $stmt = $conn->prepare("SELECT * FROM 002orders WHERE order_id LIKE ? ORDER BY placed_on DESC");
    $likeQ = "%$q%";           
    $stmt->bind_param("s", $likeQ);  
} else {
    $stmt = $conn->prepare("SELECT * FROM 002orders ORDER BY placed_on DESC");
}

// Ejecutar consulta
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();

// Devolver JSON
echo json_encode($orders);
exit;
?>
