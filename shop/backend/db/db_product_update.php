<?php
include  __DIR__ . '/../config/db_connection.php';

// Obtener datos de un producto por ID
function obtenerProducto($product_id) {
    global $connection;

    $stmt = $connection->prepare(
        "SELECT product_name, product_price, stock, category_id 
                FROM products 
                WHERE product_id = ?"
    );

    $stmt->bind_param("i", $product_id);

    $stmt->execute();

    $result = $stmt->get_result();

    $producto = $result->fetch_assoc();
    $stmt->close();

    return $producto ?: null;
}

// Actualizar un producto existente
function actualizarProducto($product_id, $nombre, $precio, $stock, $categorias) {
    global $connection;

    $stmt = $connection->prepare(
        "UPDATE products SET product_name = ?, product_price = ?, stock = ?, category_id = ? WHERE product_id = ?"
    );
    $stmt->bind_param("sdssi", $nombre, $precio, $stock, $categorias, $product_id);
    $resultado = $stmt->execute();
    $stmt->close();

    return $resultado;
}
?>
