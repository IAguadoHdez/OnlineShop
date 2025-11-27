<?php
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/db/db_shop_cart.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /student002/shop/backend/login.php");
    exit;
}

$customer_id = $_SESSION['user_id'];

// Obtener productos del carrito
$sql = "SELECT c.cart_id, c.quantity, p.product_id, p.product_name, p.product_price
        FROM 002shopping_cart c
        JOIN 002products p ON c.product_id = p.product_id
        WHERE c.customer_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
$productos = $result->fetch_all(MYSQLI_ASSOC);

if (!$productos) {
    echo "<p>Your cart is empty. <a href='products.php'>Go back</a></p>";
    exit;
}

// Manejar envío de formularios para cada paso
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $step_post = intval($_POST['step'] ?? 1);

    if ($step_post === 1) {
        // Guardar dirección de envío
        $_SESSION['shipping'] = [
            'street' => $_POST['street'],
            'floor'  => $_POST['floor'],
            'zipcode'=> $_POST['zipcode'],
            'city'   => $_POST['city'],
            'country' => $_POST['country']
        ];
        header("Location: checkout.php?step=2");
        exit;
    }

    if ($step_post === 2) {
        // Guardar método de pago
        $_SESSION['payment_method'] = $_POST['payment_method'];
        header("Location: checkout.php?step=3");
        exit;
    }
}

// Determinar paso actual
$step = intval($_GET['step'] ?? 1);
?>

<main class="h-[calc(100vh-84px)] bg-background text-texto py-12 flex justify-center">
    <div class="bg-[#eeeeee] p-6 rounded-xl shadow-xl h-100">

        <?php if ($step === 1): ?>
            <h2 class="text-2xl font-bold mb-4">Dirección de envío</h2>
            <form method="POST">
                <input type="hidden" name="step" value="1">
                <input type="text" name="street" placeholder="Calle" required class="w-full mb-2 p-2 border rounded">
                <input type="text" name="floor" placeholder="Piso / Apartamento" class="w-full mb-2 p-2 border rounded">
                <input type="text" name="zipcode" placeholder="Código postal" required class="w-full mb-2 p-2 border rounded">
                <input type="text" name="city" placeholder="Ciudad" required class="w-full mb-2 p-2 border rounded">
                <input type="text" name="country" placeholder="País" required class="w-full mb-2 p-2 border rounded">
                <button type="submit" class="buttons w-full mt-4">Siguiente</button>
            </form>

        <?php elseif ($step === 2): ?>
                <h2 class="text-2xl font-bold mb-4">Método de pago</h2>
                <form method="POST">
                    <input type="hidden" name="step" value="2">
                    <select name="payment_method" required class="w-full mb-4 p-2 border rounded">
                        <option value="">Selecciona método de pago</option>
                        <option value="credit_card">Tarjeta de credito</option>
                        <option value="paypal">PayPal</option>
                        <option value="cash">Efectivo en entrega</option>
                    </select>
                    <button type="submit" class="buttons w-full">Siguiente</button>
                </form>

        <?php elseif ($step === 3): ?>
            <h2 class="text-2xl font-bold mb-4">Confirmación de pedido</h2>
            <ul class="mb-4">
                <?php 
                $total = 0;
                foreach ($productos as $p): 
                    $line_total = $p['product_price'] * $p['quantity'];
                    $total += $line_total; 
                ?>
                    <li><?= $p['product_name'] ?> x <?= $p['quantity'] ?> = <?= number_format($line_total, 2) ?> €</li>
                <?php endforeach; ?>
            </ul>
            <p class="mb-4 font-bold">Total: <?= number_format($total, 2) ?> €</p>

            <!-- Enviar datos a db_checkout.php para procesar la orden -->
            <form method="POST" action="/student002/shop/backend/db/db_checkout.php">
                <input type="hidden" name="step" value="3">
                <button type="submit" class="buttons w-full">Compra Ahora</button>
            </form>

        <?php endif; ?>

    </div>
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/footer.php'; ?>
