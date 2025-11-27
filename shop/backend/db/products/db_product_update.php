<?php
 require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php'; 


// Obtener producto por ID
function obtenerProducto($id)
{
    global $conn;
    $query = $conn->prepare("SELECT product_name, product_price, stock, category_id, product_image FROM 002products WHERE product_id=?");
    $query->bind_param("i", $id);
    $query->execute();
    $producto = $query->get_result()->fetch_assoc();
    $query->close();
    return $producto;
}

// Actualizar producto
function actualizarProducto($id, $nombre, $precio, $stock, $categoria, $img)
{
    global $conn;
    $query2 = $conn->prepare("UPDATE 002products SET product_name=?, product_price=?, stock=?, category_id=?, product_img=? WHERE product_id=?");
    $ok = $query2->execute();
    $query2->close();
    return $ok;
}
