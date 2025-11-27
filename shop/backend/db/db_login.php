<?php
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = ($_POST['email']);
    $password = $_POST['password'];

    // Preparar consulta
    $query = $conn->prepare("SELECT customer_id, customer_name, password, rol FROM `002customers` WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();
    $user = $result->fetch_assoc();

    // Validar usuario y contraseña
    if ($user && $password === $user['password']) {
        $_SESSION['user_name'] = $user['customer_name'];
        $_SESSION['user_id'] = $user['customer_id'];
        $_SESSION['role'] = $user['rol'];
        header("Location: /student002/shop/backend/public/index.php");
        exit;
    } else {
        $error = "Correo o contraseña incorrectos";
        header("Location: /student002/shop/backend/login.php");
    }
}
