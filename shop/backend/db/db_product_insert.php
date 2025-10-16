<?php
include __DIR__ . '/../config/db_connection.php';


// Insertar un nuevo producto
function insertarProducto($nombre, $precio, $cantidad, $categoria_id) {
    global $connection;

    $stmt = $connection->prepare(
        "INSERT INTO products (product_name, product_price, stock, category_id) VALUES (?, ?, ?, ?)"
    );

    $stmt->bind_param("sdii", $nombre, $precio, $cantidad, $categoria_id);
    $resultado = $stmt->execute();
    $stmt->close();

    return $resultado;
}
?>
