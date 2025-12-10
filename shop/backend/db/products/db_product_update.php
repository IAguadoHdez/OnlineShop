<?php
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';


// Obtener producto por ID
function obtenerProducto($id)
{
    global $conn;
    $query = $conn->prepare("SELECT product_name, product_price, quantity, category_id, product_image FROM 002products WHERE product_id=?");
    $query->bind_param("i", $id);
    $query->execute();
    $producto = $query->get_result()->fetch_assoc();
    $query->close();
    return $producto;
}

// Actualizar producto
function actualizarProducto($id, $nombre, $precio, $quantity, $categoria, $img)
{
    global $conn;

    $sql = "UPDATE 002products 
            SET product_name=?, product_price=?, quantity=?, category_id=?, product_image=?
            WHERE product_id=?";

    $query = $conn->prepare($sql);

    if (!$query) {
        return false;
    }

    $query->bind_param("ssiisi", $nombre, $precio, $quantity, $categoria, $img, $id);

    $ok = $query->execute();
    $query->close();

    return $ok;
}


