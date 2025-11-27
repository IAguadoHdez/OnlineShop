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
// Obtener direcciones del cliente
$addresses = [];
$addresses_sql = "SELECT a.address_id, a.street, a.floor, a.city, a.zipcode, a.country 
        FROM 002addresses a
        WHERE a.customer_id = ?";

$stmt = $conn->prepare($addresses_sql);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
$addresses = $result->fetch_all(MYSQLI_ASSOC);

// Manejo de formularios para cada paso
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $step_post = intval($_POST['step'] ?? 1);

    if ($step_post === 1) {
        if (!empty($_POST['selected_address'])) {
            // Guardar la dirección existente seleccionada del cliente
            $selected_id = intval($_POST['selected_address']);
            $stmt = $conn->prepare("SELECT street, floor, zipcode, city, country FROM 002addresses WHERE address_id = ? AND customer_id = ?");
            $stmt->bind_param("ii", $selected_id, $customer_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $addr = $result->fetch_assoc();
            if ($addr) {
                $_SESSION['shipping'] = $addr;
            }
        } else {
            // Guardar nueva dirección
            $_SESSION['shipping'] = [
                'street' => $_POST['street'],
                'floor' => $_POST['floor'],
                'zipcode' => $_POST['zipcode'],
                'city' => $_POST['city'],
                'country' => $_POST['country']
            ];
        }
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

<main class="h-[calc(100vh-180px)] bg-background text-texto py-12 flex justify-center">
    <div class="bg-[#eeeeee] p-6 rounded-xl shadow-xl h-fit">

        <div class="flujo-de-pasos flex items-center justify-center gap-2">
            <?php if ($step === 1): ?>
                <div class="paso1 flex flex-col items-center p-4 gap-2 bg-textoSecundario/30 rounded">
                    <i class="fa-solid fa-location-dot fa-xl"></i>
                    <small>Dirección de envio</small>
                </div>
                <hr class="w-10">
                <div class=" paso2 flex flex-col items-center justify-center gap-2 p-4">
                    <i class="fa-solid fa-wallet fa-xl"></i>
                    <small>Métodos de pago</small>
                </div>
                <hr class="w-10">
                <div class="paso3 p-4 flex flex-col items-center gap-2">
                    <i class="fa-solid fa-check fa-xl"></i>
                    <small>Confirmación de pedido</small>
                </div>

            <?php endif; ?>
            <?php if ($step === 2): ?>
                <div class=" paso2 flex flex-col items-center justify-center gap-2 p-4 bg-textoSecundario/30 rounded">
                    <i class="fa-solid fa-wallet fa-xl"></i>
                    <small>Métodos de pago</small>
                </div>
            <?php endif; ?>
            <?php if ($step === 3): ?>
                <div class="paso3 p-4 flex flex-col items-center gap-2 bg-textoSecundario/30 rounded">
                    <i class="fa-solid fa-check fa-xl"></i>
                    <small>Confirmación de pedido</small>
                </div>
            <?php endif; ?>
        </div>


        <?php if ($step === 1): ?>
            <h2 class="text-2xl font-bold mb-4">Dirección de envío</h2>
            <?php if (!empty($addresses)): ?>
                <form method="POST">
                    <input type="hidden" name="step" value="1">

                    <p class="mb-2 font-semibold">Selecciona una dirección existente:</p>
                    <?php foreach ($addresses as $index => $addr): ?>
                        <div class="mb-2 border p-2 rounded flex items-center gap-2">
                            <input type="radio" name="selected_address" value="<?= $addr['address_id'] ?>"
                                id="addr<?= $addr['address_id'] ?>">
                            <label for="addr<?= $addr['address_id'] ?>" class="flex flex-col">
                                <span><?= htmlspecialchars($addr['street'], ENT_QUOTES) ?>,
                                    <?= htmlspecialchars($addr['floor'], ENT_QUOTES) ?></span>
                                <span><?= htmlspecialchars($addr['zipcode'], ENT_QUOTES) ?>
                                    <?= htmlspecialchars($addr['city'], ENT_QUOTES) ?></span>
                                <span><?= htmlspecialchars($addr['country'], ENT_QUOTES) ?></span>
                            </label>
                        </div>
                    <?php endforeach; ?>
                    <p class="my-4 font-semibold">O introduce una nueva dirección:</p>
                    <input type="text" name="street" placeholder="Calle" class="w-full mb-2 p-2 border rounded">
                    <input type="text" name="floor" placeholder="Piso / Apartamento" class="w-full mb-2 p-2 border rounded">
                    <input type="text" name="zipcode" placeholder="Código postal" class="w-full mb-2 p-2 border rounded">
                    <input type="text" name="city" placeholder="Ciudad" class="w-full mb-2 p-2 border rounded">
                    <input type="text" name="country" placeholder="País" class="w-full mb-2 p-2 border rounded">

                    <button type="submit" class="buttons w-full mt-4">Siguiente</button>
                </form>
            <?php else: ?>
                <p>No tienes direcciones guardadas. Introduce una nueva:</p>
                <form method="POST">
                    <input type="hidden" name="step" value="1">
                    <input type="text" name="street" placeholder="Calle" required class="w-full mb-2 p-2 border rounded">
                    <input type="text" name="floor" placeholder="Piso / Apartamento" class="w-full mb-2 p-2 border rounded">
                    <input type="text" name="zipcode" placeholder="Código postal" required
                        class="w-full mb-2 p-2 border rounded">
                    <input type="text" name="city" placeholder="Ciudad" required class="w-full mb-2 p-2 border rounded">
                    <input type="text" name="country" placeholder="País" required class="w-full mb-2 p-2 border rounded">
                    <button type="submit" class="buttons w-full mt-4">Siguiente</button>
                </form>
            <?php endif; ?>
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