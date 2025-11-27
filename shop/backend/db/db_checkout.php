<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';
include $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/db/db_shop_cart.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /student002/shop/backend/login.php");
    exit;
}

$customer_id = $_SESSION['user_id'];

// Verificar que existan datos de dirección y método de pago
if (!isset($_SESSION['shipping']) || !isset($_SESSION['payment_method'])) {
    header("Location: /student002/shop/backend/checkout.php?step=1");
    exit;
}

$shipping = $_SESSION['shipping'];
$payment_method = $_SESSION['payment_method'];

// Obtener productos del carrito del usuario
$stmt = $conn->prepare("
    SELECT c.cart_id, c.quantity, p.product_id, p.product_name, p.product_price
    FROM 002shopping_cart c
    JOIN 002products p ON c.product_id = p.product_id
    WHERE c.customer_id = ?
");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
$productos = $result->fetch_all(MYSQLI_ASSOC);

// Insertar cada producto como orden
foreach ($productos as $p) {
    $total_price = $p['product_price'] * $p['quantity'];
    $placed_on = date("Y-m-d");


    $insert = $conn->prepare("
    INSERT INTO 002orders 
    (customer_id, product_id, quantity, total_price, street, floor, zipcode, city, country, payment_method, placed_on)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

    $insert->bind_param(
        "iiidsssssss",
        $customer_id,
        $p['product_id'],
        $p['quantity'],
        $total_price,
        $shipping['street'],
        $shipping['floor'],
        $shipping['zipcode'],
        $shipping['city'],
        $shipping['country'],
        $payment_method,
        $placed_on 
    );


    $insert->execute();
    $insert->close();
}

// Vaciar carrito del usuario
$delete = $conn->prepare("DELETE FROM 002shopping_cart WHERE customer_id = ?");
$delete->bind_param("i", $customer_id);
$delete->execute();
$delete->close();

// Limpiar sesión temporalmente
unset($_SESSION['shipping']);
unset($_SESSION['payment_method']);

// Redirigir a página de éxito
header("Location: /student002/shop/backend/checkout_success.php");
exit;
