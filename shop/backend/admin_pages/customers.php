<?php
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';


// Traer a todos los clientes
$stmt = $conn->prepare("
    SELECT *
    FROM 002customers
");

$stmt->execute();
$result = $stmt->get_result();
$customers = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

?>

<main class="h-[calc(100vh-160px)] bg-background text-texto p-6">
  <h1 class="text-3xl font-bold mb-6 text-center">Clientes</h1>

  <?php if ($customers): ?>
    <div class="flex flex-wrap gap-6">
      <?php foreach ($customers as $customer): ?>
        <ul>
          <li class="bg-[#eeeeee] border-2 shadow-2xl hover:scale-101 rounded-xl p-10 w-60 flex flex-col items-center text-center transition-transform border-textoSecundario/60">
            <h2>Nombre: <?=  htmlspecialchars($customer['customer_name'] . ' ' . $customer['lastname'])?></h2>
            <div>
              <p><?=  $customer['email'] . '  ' . $customer['phone'] ?></p>
            </div>
            <div class="flex">
              <?php include $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/forms/customers/form_customer_update_call.php' ?>
              <?php include $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/forms/customers/form_customer_delete_call.php' ?>
            </div>
          </li>
        </ul>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p>No hay pedidos disponibles.</p>
  <?php endif; ?>
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/footer.php'; ?>