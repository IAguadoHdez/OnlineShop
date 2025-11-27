<?php
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';

session_start();
$id = $_SESSION['user_id'] ?? null;
if (!$id) {
    header("Location: /student002/shop/backend/login.php");
    exit;
}
if (isset($_POST['add_address'])) {
    $street  = $_POST['street'] ?? '';
    $floor   = $_POST['floor'] ?? '';
    $city    = $_POST['city'] ?? '';
    $zipcode = $_POST['zipcode'] ?? '';
    $country = $_POST['country'] ?? '';

    // Preparar la consulta
    $stmt = $conn->prepare("INSERT INTO `002addresses` (customer_id, street, floor, city, zipcode, country) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("isssss", $id, $street, $floor, $city, $zipcode, $country);
        $stmt->execute();
        $stmt->close();
    }
}

header("Location: /student002/shop/backend/customer_pages/myprofile.php");
exit;
