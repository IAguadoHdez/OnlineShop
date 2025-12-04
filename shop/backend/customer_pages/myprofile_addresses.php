<?php
$id = $_SESSION['user_id'] ?? null;
if (!$id) {
  header("Location: /student002/shop/backend/login.php");
  exit;
}

$addresses = [];
$sql = "SELECT address_id, street, floor, city, zipcode, country 
        FROM 002addresses 
        WHERE customer_id = $id";

$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $addresses[] = $row;
  }
}
?>

<div class="relative flex flex-col bg-[#eeeeee] shadow-2xl rounded-2xl p-4 w-full h-70">
  <h3 class="font-semibold text-xl">Direcciones de envío</h3>

  <?php if (!empty($addresses)): ?>
    <ul class="space-y-2 text-left mt-4">
      <?php foreach ($addresses as $index => $addr): ?>
        <li class="border p-2 rounded flex justify-between items-center">
          <!-- Mostrar resumen de la dirección del cliente -->
          <?= htmlspecialchars($addr['street']) ?>, <?= htmlspecialchars($addr['city']) ?>
          </span>

          <div class="flex gap-2">
            <!-- Editar -->
            <button type="button" class="icono fa-solid fa-pen-to-square" onclick="openEditPopup(
                '<?= $addr['address_id'] ?>',
                '<?= htmlspecialchars($addr['street'], ENT_QUOTES) ?>',
                '<?= htmlspecialchars($addr['floor'], ENT_QUOTES) ?>',
                '<?= htmlspecialchars($addr['city'], ENT_QUOTES) ?>',
                '<?= htmlspecialchars($addr['zipcode'], ENT_QUOTES) ?>',
                '<?= htmlspecialchars($addr['country'], ENT_QUOTES) ?>'
              )">
            </button>

            <!-- Eliminar -->
            <button type="button" class="icono fa-solid fa-trash"
              onclick="openDeletePopup('<?= $addr['address_id'] ?>')"></button>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p class="text-sm">No tienes direcciones guardadas.</p>
  <?php endif; ?>

  <!-- Botón para abrir popup de nueva dirección -->
  <button type="button" class="buttons p-2 w-full mt-4" onclick="openPopup()">Añadir dirección</button>

  <!-- Popup para confirmar eliminar dirección -->
  <div id="deletePopup" class="hidden absolute inset-0 flex items-center justify-center bg-black/50 z-50">
    <div class="bg-[#eeeeee] rounded-lg shadow-lg p-6 w-full max-w-md">
      <h3 class="font-semibold text-xl mb-4">¿Eliminar dirección?</h3>

      <form method="POST" action="/student002/shop/backend/db/db_addresses_delete.php">
        <input type="hidden" name="delete_address_id" id="delete_address_id">
        <button type="submit" class="buttons w-full">Sí, eliminar</button>
      </form>

      <button type="button" onclick="closeDeletePopup()" class="buttons w-full mt-2">Cancelar</button>
    </div>
  </div>

  <!-- Popup para editar dirección -->
  <div id="editPopup" class="hidden absolute inset-0 flex items-center justify-center bg-black/50 z-50">
    <div class="bg-[#eeeeee] rounded-lg shadow-lg p-6 w-full max-w-md flex flex-col gap-2">
      <h3 class="font-semibold text-xl mb-4">Editar dirección</h3>

      <form method="POST" action="/student002/shop/backend/db/db_addresses_update.php" class="flex flex-col gap-2">
        <input type="hidden" name="address_id" id="edit_address_id">
        <input type="text" name="street" id="edit_street" class="inputs">
        <input type="text" name="floor" id="edit_floor" class="inputs">
        <input type="text" name="city" id="edit_city" class="inputs">
        <input type="text" name="zipcode" id="edit_zipcode" class="inputs">
        <input type="text" name="country" id="edit_country" class="inputs">
        <button type="submit" name="update_address" class="buttons w-full">Guardar cambios</button>
      </form>

      <button type="button" onclick="closeEditPopup()" class="buttons w-full">Cerrar</button>
    </div>
  </div>

  <!-- Popup para añadir dirección -->
  <div id="addressPopup" class="hidden absolute inset-0 flex items-center justify-center bg-black/50 z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md flex flex-col gap-2">
      <h3 class="font-semibold text-xl mb-4">Nueva dirección</h3>
      <form method="POST" action="/student002/shop/backend/db/db_addresses_insert.php" class="flex flex-col gap-2">
        <input type="text" name="street" placeholder="Calle" class="inputs" required>
        <input type="text" name="floor" placeholder="Piso" class="inputs">
        <input type="text" name="city" placeholder="Ciudad" class="inputs" required>
        <input type="text" name="zipcode" placeholder="Código Postal" class="inputs" required>
        <input type="text" name="country" placeholder="País" class="inputs" required>
        <button type="submit" name="add_address" class="buttons w-full">Guardar dirección</button>
      </form>
      <button type="button" onclick="closePopup()" class="buttons  w-full">Cerrar</button>
    </div>
  </div>
</div>

<script src="/student002/shop/js/myprofile_addresses.js"></script>