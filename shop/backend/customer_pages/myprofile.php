<?php
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/db/customers/db_customer_update.php';
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';

$id = $_SESSION['user_id'] ?? null;
if (!$id) {
  header("Location: /student002/shop/backend/login.php");
  exit;
}

$customer = getCustomer($id);

// Variable para controlar el mensaje de éxito
$showSuccess = false;

if (isset($_POST['update'])) {
  // Solo mostramos mensaje si realmente se actualizó en la base de datos
  if (
    updateCustomer(
      $id,
      $_POST['customer_name'],
      $_POST['lastname'],
      $_POST['email'],
      $_POST['phone']
    )
  ) {
    $customer = getCustomer($id); // actualizar datos
    $showSuccess = true;
  }
}
?>
<main class="min-h-screen bg-background flex text-texto">

  <!-- Contenido Principal -->
  <section class="flex flex-col xl:flex-row gap-10 items-center w-full">
    <div class="flex-1 rounded-lg shadow p-8">
      <h2 class="font-bold text-2xl text-texto">
        <?= htmlspecialchars($customer['customer_name'] . ' ' . $customer['lastname']); ?></h2>

      <h3 class="text-2xl font-semibold pb-3 mb-6 mt-6">Detalles de la cuenta</h3>

      <!-- Mensaje de éxito solo si update es existente -->
      <?php if ($showSuccess): ?>
        <div id="success-message"
          class="font-bold mb-4 w-[300px] p-2 rounded-2xl bg-texto text-background shadow-xl flex gap-2 items-center">
          <span class="fa-solid fa-check" style="color: lightgreen"></span>
          <p>Cambios guardados correctamente!</p>
        </div>
      <?php endif; ?>

      <form method="POST"
        class="bg-[#eeeeee] flex flex-wrap gap-4 p-10 rounded-2xl mt-6 shadow-2xl text-texto hover:scale-101 transition-all">
        <input type="hidden" name="customer_id" value="<?= $id ?>">

        <div class="flex flex-col w-full md:w-[48%]">
          <label class="text-sm">Nombre</label>
          <input type="text" name="customer_name" value="<?= htmlspecialchars($customer['customer_name']) ?>"
            class="inputs">
        </div>

        <div class="flex flex-col w-full md:w-[48%]">
          <label class="text-sm">Apellidos</label>
          <input type="text" name="lastname" value="<?= htmlspecialchars($customer['lastname']) ?>" class="inputs">
        </div>

        <div class="flex flex-col w-full">
          <label class="text-sm">Email</label>
          <input type="email" name="email" value="<?= htmlspecialchars($customer['email']) ?>" class="inputs">
        </div>

        <div class="flex flex-col w-full mb-4">
          <label class="text-sm">Número de teléfono</label>
          <input type="tel" name="phone" value="<?= htmlspecialchars($customer['phone'] ?? '') ?>" class="inputs">
        </div>

        <button type="submit" name="update" class="buttons w-[200px]">Guardar cambios
        </button>
      </form>

      <!-- Opciones debajo -->
      <div class="flex flex-col xl:flex-row gap-4 justify-center text-texto items-center text-center mt-4">
        <div class="w-full">
          <?php include $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/customer_pages/myprofile_reviews.php' ?>
        </div>
        <div class="w-full">
          <?php include $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/customer_pages/myprofile_addresses.php' ?>
        </div>

        <div class="w-full">
          <?php include $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/customer_pages/myprofile_orders.php'; ?>
        </div>

      </div>
    </div>
  </section>

  <script>
    // Eliminamos el mensaje de exito después de 3 segundos
    document.addEventListener("DOMContentLoaded", () => {
      const msg = document.getElementById("success-message");
      if (msg) {
        setTimeout(() => msg.remove(), 3000);
      }
    });
  </script>
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/footer.php'; ?>