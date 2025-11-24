<?php

require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/db/db_customer_update.php';

// Comprobar sesión iniciada
$id = $_SESSION['user_id'] ?? null;
if (!$id) {
  header("Location: /student002/shop/backend/login.php");
  exit;
}

$customer = getCustomer($id);

// Procesar actualización
$successMessage = '';
if (isset($_POST['update'])) {
  if (
    updateCustomer(
      $id,
      $_POST['customer_name'],
      $_POST['lastname'],
      $_POST['email'],
      $_POST['phone']
    )
  ) {
    $customer = getCustomer($id);
    $successMessage = "
    <div class='flex gap-2 bg-texto shadow-xl w-[300px] p-2 rounded-2xl'>
    <p><span class='fa-solid fa-check' style='color: lightgreen'></span>Cambios guardados correctamente!</p> 
    </div>";
  }
}
?>


<main class="min-h-screen bg-background flex text-texto">
  <!-- Sidebar -->
  <aside class="hidden md:flex flex-col p-6 h-screen">
    <div class="flex flex-col items-center gap-4 mb-10 text-center">
      <form>
        <label for="image_change">
          <div>
            <img src="../assets/images/persona/persona.jpg"
              class="w-20 h-20 rounded-full object-cover filter hover:brightness-50 hover:cursor-pointer">
          </div>
        </label>
        <input type="file" name="image_change" id="image_change" class="hidden" accept="image/*">
      </form>
      <!-- Nombre y apellidos centrados -->
      <h2 class="font-bold text-2xl text-texto">
        <?= htmlspecialchars($customer['customer_name'] . ' ' . $customer['lastname']); ?>
      </h2>
    </div>
  </aside>


  <!-- Contenido Principal -->
  <section class="flex flex-col xl:flex-row gap-10  items-center">
    <!-- Bloque izquierdo -->
    <div class="flex-1 rounded-lg shadow p-8">
      <h3 class="text-2xl font-semibold pb-3 mb-6">Account details</h3>

      <?php if ($successMessage): ?>
        <p class="font-bold mb-4"><?= $successMessage ?></p>
      <?php endif; ?>

      <form method="POST"
        class="flex flex-wrap gap-4 p-10 rounded-2xl mt-6 shadow-2xl text-texto hover:scale-101 transition-all">
        <input type="hidden" name="customer_id" value="<?= $id ?>">

        <div class="flex flex-col w-full md:w-[48%]">
          <label class="text-sm">Name</label>
          <input type="text" name="customer_name" value="<?= htmlspecialchars($customer['customer_name']) ?>"
            class="inputs">
        </div>

        <div class="flex flex-col w-full md:w-[48%]">
          <label class="text-sm ">Surnames</label>
          <input type="text" name="lastname" value="<?= htmlspecialchars($customer['lastname']) ?>" class="inputs">
        </div>

        <div class="flex flex-col w-full">
          <label class="text-sm">Email</label>
          <input type="email" name="email" value="<?= htmlspecialchars($customer['email']) ?>" class="inputs">
        </div>

        <div class="flex flex-col w-full mb-4">
          <label class="text-sm">Phone number</label>
          <input type="tel" name="phone" value="<?= htmlspecialchars($customer['phone']) ?>" class="inputs">
        </div>

        <button type="submit" name="update" class="buttons w-[200px]">
          Save changes
        </button>
      </form>

      <!-- Opciones debajo -->
      <div class="flex flex-col xl:flex-row gap-4 justify-center text-texto items-center text-center mt-4">
        <div class="flex flex-col bg-background shadow-2xl hover:scale-101 transition-all rounded-2xl p-4 w-full">
          <?php include $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/forms/customers/form_update_password_call.php' ?>
        </div>

        <div class="flex flex-col bg-background  shadow-2xl hover:scale-101 transition-all rounded-2xl p-4 w-full">
          <form class="flex flex-col gap-4">
            <h3 class="font-semibold text-xl">Shipping Addresses</h3>
            <button class="buttons p-2 w-full">Add new address</button>
          </form>
        </div>

        <div class="flex flex-col bg-background  shadow-2xl hover:scale-101 transition-all rounded-2xl p-4 w-full">
          <form class="flex flex-col gap-4">
            <h3 class="font-semibold text-xl">Payment Methods</h3>
            <button class="buttons p-2 w-full">Add new method</button>
          </form>
        </div>
      </div>

      <div class="bg-background  hover:scale-101 transition-all rounded-2xl p-4 w-full mt-10 shadow-xl">
        <h3 class="font-semibold text-xl mb-4">Recent Orders</h3>
        <ul class="text-sm space-y-2">
          <li class="flex justify-between">
            <span>Order #4251</span>
            <span class="text-green-500 font-semibold">Delivered</span>
          </li>
          <li class="flex justify-between">
            <span>Order #4217</span>
            <span class="text-yellow-500 font-semibold">Processing</span>
          </li>
          <li class="flex justify-between">
            <span>Order #4198</span>
            <span class="text-blue-500 font-semibold">Shipped</span>
          </li>
        </ul>
        <button class="buttons p-2 w-full mt-4">
          View all
        </button>
      </div>
    </div>

  </section>

  <script src="../js/myprofile.js"></script>
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/footer.php'; ?>