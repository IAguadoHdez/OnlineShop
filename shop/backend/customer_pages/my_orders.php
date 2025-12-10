<?php
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';

$customer_id = $_SESSION['user_id'] ?? null;
if (!$customer_id) {
    header("Location: /student002/shop/backend/login.php");
    exit;
}

// Traer todas las órdenes del usuario
$stmt = $conn->prepare("
    SELECT *
    FROM 002orders
    WHERE customer_id = ?
    ORDER BY order_id DESC
");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

?>

<main class="min-h-screen bg-background text-texto p-6">
    <h1 class="text-3xl font-bold mb-6">Todos mis pedidos</h1>

    <?php if ($orders): ?>
        <div class="grid gap-6">
            <?php foreach ($orders as $order): ?>
                <div class="bg-[#eeeeee] p-4 rounded-xl shadow-lg">
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold">Pedido #<?= $order['order_id'] ?></span>
                        <span class="text-texto"><?= date("d/m/Y", strtotime($order['placed_on'])) ?></span>

                    </div>
                    <p class="mb-2 text-sm">
                        Envío:
                        <?= htmlspecialchars($order['street'] . ' ' . $order['floor'] . ', ' . $order['zipcode'] . ' ' . $order['city']) ?>
                    </p>
                    <p class="mb-2 text-sm">Método de pago: <?= htmlspecialchars($order['payment_method']) ?></p>
                    <p class="mb-2 font-semibold">Total: <?= number_format($order['total_price'], 2) ?> €</p>
                    <p class="font-semibold">Estado: <span class="text-accent"><?= htmlspecialchars($order['status']) ?></span>
                    </p>
                </div>

            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No hay pedidos disponibles.</p>
    <?php endif; ?>

    <a href="/student002/shop/backend/customer_pages/myprofile.php"
        class="buttons  text-center w-full mt-6 inline-block">Volver a mi perfil</a>
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/footer.php'; ?>