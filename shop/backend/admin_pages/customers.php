<?php
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';
?>
<?php

// Traer todas los clientes al cargar la página
$stmt = $conn->prepare("SELECT * FROM 002customers ORDER BY customer_id DESC");
$stmt->execute();
$result = $stmt->get_result();
$customers = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<main class="min-h-screen bg-background text-texto p-6">
  <h1 class="text-3xl font-bold mb-6 text-center">Pedidos</h1>

  <!-- Input de búsqueda -->
  <div class="mb-6 text-center">
    <input type="text" id="search" placeholder="Buscar cliente..." class="inputs">
  </div>

  <!-- Contenedor de pedidos -->
  <div id="customer-container" class="flex gap-5 flex-wrap">


   <?php if ($customers) {
    foreach ($customers as $customer) {
    echo '<div class="bg-[#eeeeee] p-4 rounded-xl shadow-lg">';
      echo '<div class="flex justify-between mb-2">';
        echo '<span class="font-semibold">Cliente #' . $customer['customer_id'] . '</span>';
        echo '</div>';
      echo '<p class="mb-2 text-sm">Nombre: ' . htmlspecialchars($customer['customer_name'] . ' ' . $customer['lastname']) . '</p>';
      echo '<p class="mb-2 text-sm">Email: ' . htmlspecialchars($customer['email']) . '</p>';
      echo '<p class="mb-2 font-semibold">Teléfono: ' .htmlspecialchars($customer['phone']) . '</p>';
      echo '</div>';
    }
    } else {
    echo '<p>No hay clientes disponibles.</p>';
    } 
    ?>
  </div>
</main>

<script src="/student002/shop/js/endpoints/backend_customers.js"></script>


<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/footer.php'; ?>