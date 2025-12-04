<?php
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';

// Eliminar un producto por ID
function eliminarProducto($product_id)
{
    global $conn;

    $query = $conn->prepare("DELETE FROM 002products WHERE product_id = ?");
    $query->bind_param("i", $product_id);
    $query->execute();

    $eliminado = $query->affected_rows > 0;

    $query->close();
    return $eliminado;
}
?>