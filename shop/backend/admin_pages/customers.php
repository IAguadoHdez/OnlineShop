<?php
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/functions/customer_functions.php';
?>
<?php

if (!isset($_SESSION['user_id'])) {
  header("Location: /student002/shop/backend/public/login.php");
  exit;
}

if ($_SESSION['role'] !== 'customer' && $_SESSION['role'] !== 'admin') {
  die("Acceso denegado");
}

// Traer todas los clientes al cargar la página
$stmt = $conn->prepare("SELECT * FROM 002customers ORDER BY customer_id DESC");
$stmt->execute();
$result = $stmt->get_result();
$customers = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<main class="min-h-screen bg-background text-texto p-6">
  <h1 class="text-3xl font-bold mb-6 text-center">Clientes</h1>

  <!-- Input de búsqueda -->
  <div class="mb-6 text-center">
    <input type="text" id="search" placeholder="Buscar cliente..." class="inputs">
  </div>

  <!-- Contenedor de clientes -->
  <div id="customer-container" class="flex gap-5 flex-wrap">


    <?php foreach ($customers as $c)
      showCustomer($c); ?>
  </div>
</main>

<script src="/student002/shop/js/endpoints/backend_customers.js"></script>


<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/footer.php'; ?>