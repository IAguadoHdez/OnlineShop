<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';

$id = $_SESSION['user_id'] ?? null;
if (!$id) {
  header("Location: /student002/shop/backend/login.php");
  exit;
}

if (isset($_POST['update_address'])) {
    $address_id = intval($_POST['address_id']);
    $street  = $_POST['street'] ?? '';
    $floor   = $_POST['floor'] ?? '';
    $city    = $_POST['city'] ?? '';
    $zipcode = $_POST['zipcode'] ?? '';
    $country = $_POST['country'] ?? '';

    
    // Preparar la consulta
    $stmt = $conn->prepare("UPDATE 002addresses 
                            SET street = ?, floor = ?, city = ?, zipcode = ?, country = ?
                            WHERE address_id = ? AND customer_id = ?");
    if ($stmt) {
        $stmt->bind_param("ssssssi", $street, $floor, $city, $zipcode, $country, $address_id, $id);
        $stmt->execute();
        $stmt->close();
    } else {
        error_log("Error preparando la consulta: " . $conn->error);
    }
}

header("Location: /student002/shop/backend/customer_pages/myprofile.php");
exit;
