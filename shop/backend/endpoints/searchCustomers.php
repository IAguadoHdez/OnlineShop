<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');

include_once $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';

// Obtener búsqueda
$q = isset($_GET['q']) ? $_GET['q'] : '';

if ($q !== "") {
    $stmt = $conn->prepare(" SELECT * FROM 002customers  WHERE CAST(customer_id AS CHAR) LIKE ?  OR LOWER(customer_name) LIKE ? ORDER BY customer_id DESC");
    $likeQ = "%$q%";
    $stmt->bind_param("ss", $likeQ, $likeQ);
} else {
    $stmt = $conn->prepare("SELECT * FROM 002customers ORDER BY customer_id DESC");
}

// Ejecutar
$stmt->execute();
$result = $stmt->get_result();
$customers = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();

// Devolver JSON
echo json_encode($customers);
exit;
?>