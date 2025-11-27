<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';

function agregarOActualizarProducto($idProducto)
{
    global $conn;
    $customer_id = $_SESSION['user_id']; // Usuario actual

    // Verificar si el producto ya está en el carrito de este usuario
    $consulta = $conn->prepare("SELECT cart_id, quantity FROM 002shopping_cart WHERE product_id = ? AND customer_id = ?");
    $consulta->bind_param("ii", $idProducto, $customer_id);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        // Si existe, actualizar la cantidad sumando 1
        $nuevaCantidad = $fila['quantity'] + 1;
        $actualizar = $conn->prepare("UPDATE 002shopping_cart SET quantity = ? WHERE cart_id = ?");
        $actualizar->bind_param("ii", $nuevaCantidad, $fila['cart_id']);
        $actualizar->execute();
        $actualizar->close();
    } else {
        // Si no existe, insertar el producto con cantidad 1 y customer_id
        $insertar = $conn->prepare("INSERT INTO 002shopping_cart (product_id, quantity, customer_id) VALUES (?, 1, ?)");
        $insertar->bind_param("ii", $idProducto, $customer_id);
        $insertar->execute();
        $insertar->close();
    }

    $consulta->close();
}

function eliminarProducto($idCarrito)
{
    global $conn;
    $customer_id = $_SESSION['user_id'];

    $borrar = $conn->prepare("DELETE FROM 002shopping_cart WHERE cart_id = ? AND customer_id = ?");
    $borrar->bind_param("ii", $idCarrito, $customer_id);
    $borrar->execute();
    $borrar->close();
}


function restarProducto($idProducto)
{
    global $conn;
    $customer_id = $_SESSION['user_id'];

    // Verificar que el producto esté en el carrito del usuario
    $consulta = $conn->prepare("SELECT cart_id, quantity FROM 002shopping_cart WHERE product_id = ? AND customer_id = ?");
    $consulta->bind_param("ii", $idProducto, $customer_id);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        $nuevaCantidad = $fila['quantity'] - 1;
        if ($nuevaCantidad <= 0) {
            // Si llega a 0, eliminar el producto del carrito
            eliminarProducto($fila['cart_id']);
        } else {
            $actualizar = $conn->prepare("UPDATE 002shopping_cart SET quantity = ? WHERE cart_id = ?");
            $actualizar->bind_param("ii", $nuevaCantidad, $fila['cart_id']);
            $actualizar->execute();
            $actualizar->close();
        }
    }

    $consulta->close();
}

?>