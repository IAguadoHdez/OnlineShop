<?php
include __DIR__ . '/../config/db_connection.php';

// Eliminar un cliente por ID
function eliminarCliente($customer_id) {
    global $connection;

    $stmt = $connection->prepare(
        "DELETE FROM customer WHERE customer_id = ?"
    );

    $stmt->bind_param("i", $customer_id);

    $stmt->execute();

    $afectadas = $stmt->affected_rows;

    $stmt->close();

    return $afectadas > 0;
}
?>
