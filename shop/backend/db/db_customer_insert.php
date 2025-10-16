<?php
include  __DIR__ . '/../config/db_connection.php';

// Insertar un nuevo cliente
function insertarCustomer($nombre, $apellido, $email, $telefono) {
    global $connection;

    $stmt = $connection->prepare(
        "INSERT INTO customer (customer_name, customer_lastname, email, phone) VALUES (?, ?, ?, ?)"
    );
    $stmt->bind_param("ssss", $nombre, $apellido, $email, $telefono);

    $resultado = $stmt->execute();

    $stmt->close();
    return $resultado; 
}
?>
