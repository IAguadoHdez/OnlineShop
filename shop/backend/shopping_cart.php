<?php 
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/header.php'; 
include $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/db/db_shop_cart.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /student002/shop/backend/login.php");
    exit;
}

if ($_SESSION['role'] !== 'customer' && $_SESSION['role'] !== 'admin') {
    die("Acceso denegado");
}

// Sumar producto del carrito
if (isset($_POST['sum_product_id'])) {
    $idProducto = (int) $_POST['sum_product_id'];
    agregarOActualizarProducto($idProducto);
}

// Restar producto del carrito
if (isset($_POST['sub_product_id'])) {
    $idProducto = (int) $_POST['sub_product_id'];
    restarProducto($idProducto);
}

// Eliminar producto del carrito
if (isset($_POST['delete_cart_id'])) {
    $idCarrito = (int) $_POST['delete_cart_id'];
    eliminarProducto($idCarrito);
}

// Obtener productos del carrito
$sql = "SELECT c.cart_id, c.quantity, p.product_id, p.product_name, p.product_price, p.product_image
        FROM 002shopping_cart c
        JOIN 002products p ON c.product_id = p.product_id
        WHERE c.customer_id = {$_SESSION['user_id']}";

$result = mysqli_query($conn, $sql);
$productos = mysqli_fetch_all($result, MYSQLI_ASSOC);
$total = 0;

foreach ($productos as $p) {
    $total += $p['product_price'] * $p['quantity'];
}

?>

<main class="min-h-screen bg-background text-texto py-12 flex justify-center">
  <div class="w-full max-w-6xl flex flex-col lg:flex-row gap-8 px-4 ">
    <!-- Lista de Productos -->
    <div class=" flex-1 bg-[#eeeeee] p-6 rounded-xl shadow-xl">
      <h2 class="text-2xl font-bold text-texto mb-6">Cesta de la compra</h2>

      <?php if ($productos): ?>
        <ul>
          <?php foreach ($productos as $p): ?>
            <li class="flex items-center justify-between py-4 border rounded-xl p-4">
              <div class="flex items-center gap-4">
                <img src="<?= $p['product_image'] ?>" alt="<?= $p['product_name'] ?>"
                  class="w-20 h-20 object-cover rounded-lg">
                <div>
                  <p class="font-semibold"><?= $p['product_name'] ?></p>
                  <p class="text-texto text-sm"><?= number_format($p['product_price'], 2) ?> € x <?= $p['quantity'] ?></p>
                </div>
              </div>

              <div class="flex items-center gap-3">
                <form method="POST">
                  <input type="hidden" name="sum_product_id" value="<?= $p['product_id'] ?>">
                  <button class="icono px-3 py-1 text-call-to-action fa-solid fa-plus"></button>
                </form>
                <form method="POST">
                  <input type="hidden" name="sub_product_id" value="<?= $p['product_id'] ?>">
                  <button class="icono px-3 py-1 fa-solid fa-minus"></button>
                </form>
                <form method="POST">
                  <input type="hidden" name="delete_cart_id" value="<?= $p['cart_id'] ?>">
                  <button type="submit" class="icono fa-solid fa-trash"></button>
                </form>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <p class="text-background/60 text-center">Tu carrito esta vacio.</p>
      <?php endif; ?>
    </div>

    <!-- Total -->
    <div class="w-full lg:w-80 bg-[#eeeeee] p-6 rounded-xl shadow-lg h-fit">
      <h2 class="text-2xl font-bold mb-4 text-left">Resumen</h2>
      
      <?php foreach ($productos as $p): ?>
        <li class="flex items-center justify-between py-4">
          <div>
            <p class="font-semibold"><?= $p['product_name'] . " x " . $p['quantity'] ?></p>
          </div>
        </li>
      <?php endforeach; ?>

      <p class="text-lg mb-6">Total: <span class="font-semibold text-call-to-action"><?= number_format($total, 2) ?> €</span></p>

      <?php if ($productos): ?>
        <a href="checkout.php" class="buttons w-full text-center block">Realizar pedido</a>
      <?php else: ?>
        <button class="buttons w-full text-center block opacity-50 cursor-not-allowed" disabled>Realizar pedido</button>
        <p class="text-center text-sm text-background/60 mt-2">Añade productos a la cesta primero</p>
      <?php endif; ?>

      <a href="/student002/shop/backend/admin_pages/products.php" class="links block mt-6 text-sm text-texto-secundario transition text-center">← Volver atras</a>
    </div>
  </div>
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/footer.php'; ?>
