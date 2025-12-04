<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';

// Recuperar datos
$customer_id = $_SESSION['user_id'] ?? null;
$product_id = $_POST['product_id'] ?? null;
$mark = $_POST['mark'] ?? null;
$comment = $_POST['comment'] ?? '';


$query = $conn->prepare("
    INSERT INTO `002reviews` (customer_id, product_id, mark, comment)
    VALUES (?, ?, ?, ?)
");

$query->bind_param("iiis", $customer_id, $product_id, $mark, $comment);

if ($query->execute()) {
  header("Location: /student002/shop/backend/customer_pages/my_reviews.php");
  exit;
} else {
  echo "Error al guardar la review: " . $query->error;
}

$query->close();
$conn->close();

?>