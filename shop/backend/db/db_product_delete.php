<?php
include __DIR__ . '/../config/db_connection.php';

// Eliminar un producto por ID
function eliminarProducto($product_id) {
    global $connection;

    $stmt = $connection->prepare(
        "DELETE FROM products WHERE product_id = ?"
    );

    $stmt->bind_param("i", $product_id);

    $stmt->execute();

    $afectadas = $stmt->affected_rows;

    $stmt->close();

    return $afectadas > 0;
}
?>
