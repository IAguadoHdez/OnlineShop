<?php
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';

// Obtener cliente por ID
function eliminarCliente($id)
{
  global $conn;

  $query = $conn->prepare("DELETE FROM 002customers WHERE customer_id = ?");
  $query->bind_param("i", $customer_id);
  $query->execute();

  $eliminado = $query->affected_rows > 0;

  $query->close();
  return $eliminado;

  
}

?>