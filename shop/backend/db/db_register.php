<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = $_POST['customer_name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    // Preparar consulta
    $query = $conn->prepare("INSERT INTO `002customers` (customer_name, lastname, email, password) 
                             VALUES (?, ?, ?, ?)");

    $query->bind_param("ssss", $user, $lastname, $email, $passwordHash);

    if ($query->execute()) {
        echo "Usuario registrado con éxito 👍";

        header("Location: login.php");

    } else {
        echo "Error al registrar el usuario ";
    }

    $query->close();
    $conn->close();
}
?>