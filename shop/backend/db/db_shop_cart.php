<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php'; 

function agregarOActualizarProducto($idProducto) {
    global $conn;

    // Verificar si el producto ya está en el carrito
    $consulta = $conn->prepare("SELECT cart_id, stock FROM 002shopping_cart WHERE product_id = ?");
    $consulta->bind_param("i", $idProducto);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        // Si existe, actualizar la cantidad sumando 1
        $nuevaCantidad = $fila['stock'] + 1;
        $actualizar = $conn->prepare("UPDATE 002shopping_cart SET stock = ? WHERE cart_id = ?");
        $actualizar->bind_param("ii", $nuevaCantidad, $fila['cart_id']);
        $actualizar->execute();
        $actualizar->close();
    } else {
        // Si no existe, insertar el producto con cantidad 1
        $insertar = $conn->prepare("INSERT INTO 002shopping_cart (product_id, stock) VALUES (?, 1)");
        $insertar->bind_param("i", $idProducto);
        $insertar->execute();
        $insertar->close();
    }

    $consulta->close();
}
function eliminarProducto($idCarrito) {
    global $conn;

    $borrar = $conn->prepare("DELETE FROM 002shopping_cart WHERE cart_id = ?");
    $borrar->bind_param("i", $idCarrito);
    $borrar->execute();
    $borrar->close();
}
?>
