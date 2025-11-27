<?php
 require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php'; 

// Insertar un nuevo producto con imagen
function insertarProducto($nombre, $precio, $cantidad, $categoria_id, $imagen) {
    global $connection;

    $query = $connection->prepare(
        "INSERT INTO 002products (product_name, product_price, stock, category_id, product_image) VALUES (?, ?, ?, ?, ?)"
    );

    $query->bind_param("sdiis", $nombre, $precio, $cantidad, $categoria_id, $imagen);
    $resultado = $query->execute();
    $query->close();

    return $resultado;
}
?>
