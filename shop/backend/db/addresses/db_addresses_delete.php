<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';

$id = $_SESSION['user_id'] ?? null;
if (!$id) {
  header("Location: /student002/shop/backend/login.php");
  exit;
}

if (isset($_POST['delete_address_id'])) {
    $delete_id = intval($_POST['delete_address_id']);

    // Preparar la consulta
    $stmt = $conn->prepare("DELETE FROM 002addresses WHERE address_id = ? AND customer_id = ?");
    $stmt->bind_param("ii", $delete_id, $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: /student002/shop/backend/customer_pages/myprofile.php");
exit;
