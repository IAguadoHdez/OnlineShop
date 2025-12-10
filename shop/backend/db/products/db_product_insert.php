<?php
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';

function insertarProducto($nombre, $precio, $cantidad, $categoria_id)
{
    global $conn;

    // Convertimos los valores a los tipos correctos
    $precio = floatval($precio);
    $cantidad = intval($cantidad);
    $categoria_id = intval($categoria_id);

    $query = $conn->prepare(
        "INSERT INTO `002products` (product_name, product_price, quantity, category_id) VALUES (?, ?, ?, ?)"
    );

    if (!$query) {
        die("Error en la preparación del query: " . $conn->error);
    }

    $query->bind_param("sdii", $nombre, $precio, $cantidad, $categoria_id);

    $resultado = $query->execute();

    if (!$resultado) {
        die("Error al insertar el producto: " . $query->error);
    }

    $query->close();

    return $resultado;
}
?>
