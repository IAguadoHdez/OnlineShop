<?php
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Debes iniciar sesión.");
}

$customer_id = $_SESSION['user_id'];
$product_id  = $_POST['product_id'] ?? null;
$order_id    = $_POST['order_id'] ?? null;
$rating      = $_POST['rating'] ?? null;
$comment     = $_POST['comment'] ?? '';

if (!$product_id || !$order_id || !$rating || !$comment) {
    die("Todos los campos son obligatorios.");
}

// Validar rating
$rating = (int)$rating;
if ($rating < 1 || $rating > 5) {
    die("Valoración inválida.");
}

// Verificar si ya existe reseña
$check_stmt = $conn->prepare("SELECT review_id FROM 002reviews WHERE customer_id = ? AND product_id = ?");
$check_stmt->bind_param("ii", $customer_id, $product_id);
$check_stmt->execute();
$result_check = $check_stmt->get_result();

if ($result_check->num_rows === 0) {
    // Insertar reseña si no existe
    $insert_stmt = $conn->prepare("INSERT INTO 002reviews (customer_id, product_id, order_id, rating, comment) VALUES (?, ?, ?, ?, ?)");
    $insert_stmt->bind_param("iiiis", $customer_id, $product_id, $order_id, $rating, $comment);
    $insert_stmt->execute();
}

// Redirigir siempre a la página de pedidos/reseñas
header("Location: /student002/shop/customer_pages/my_orders_reviews.php");
exit;
