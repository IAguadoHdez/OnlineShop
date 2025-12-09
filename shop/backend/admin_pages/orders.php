<?php
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';
?>
<?php

if (!isset($_SESSION['user_id'])) {
  header("Location: /student002/shop/backend/public/login.php");
  exit;
}

if ($_SESSION['role'] !== 'customer' && $_SESSION['role'] !== 'admin') {
  die("Acceso denegado");
}

// Traer todas las órdenes al cargar la página
$stmt = $conn->prepare("SELECT * FROM 002orders ORDER BY placed_on DESC");
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<main class="min-h-screen bg-background text-texto p-6">
  <h1 class="text-3xl font-bold mb-6 text-center">Pedidos</h1>

  <!-- Input de búsqueda -->
  <div class="mb-6 text-center">
    <input type="text" id="search" placeholder="Buscar pedido..." class="inputs">
  </div>

  <!-- Contenedor de pedidos -->
  <div id="orders-container" class="flex gap-5 flex-wrap">


   <?php if ($orders) {
    foreach ($orders as $order) {
    echo '<div class="bg-[#eeeeee] p-4 rounded-xl shadow-lg">';
      echo '<div class="flex justify-between mb-2">';
        echo '<span class="font-semibold">Pedido #' . $order['order_id'] . '</span>';
        echo '<span class="text-texto">' . date("d/m/Y", strtotime($order['placed_on'])) . '</span>';
        echo '</div>';
      echo '<p class="mb-2 text-sm">Envío: ' . htmlspecialchars($order['street'] . ' ' . $order['floor'] . ', ' .
        $order['zipcode'] . ' ' . $order['city']) . '</p>';
      echo '<p class="mb-2 text-sm">Método de pago: ' . htmlspecialchars($order['payment_method']) . '</p>';
      echo '<p class="mb-2 font-semibold">Total: ' . number_format($order['total_price'], 2) . ' €</p>';
      echo '<p class="font-semibold">Estado: <span class="text-accent">' . htmlspecialchars($order['status']) . '</span>
      </p>';
      echo '</div>';
    }
    } else {
    echo '<p>No hay pedidos disponibles.</p>';
    } 
    ?>
  </div>
</main>

<script src="/student002/shop/js/endpoints/backend_orders.js"></script>


<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/footer.php'; ?>