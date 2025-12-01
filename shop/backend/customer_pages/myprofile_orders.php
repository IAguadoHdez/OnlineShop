<?php
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';

// Obtener el ID del usuario desde la sesión
$customer_id = $_SESSION['user_id'] ?? null;
if (!$customer_id) {
    echo "<p>No user logged in.</p>";
    return;
}

// Traer órdenes recientes del usuario
$stmt = $conn->prepare("
    SELECT order_id, product_id, quantity, total_price, street, floor, zipcode, city, payment_method, placed_on
    FROM 002orders
    WHERE customer_id = ?
    ORDER BY placed_on DESC
    LIMIT 5
");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<div class="bg-[#eeeeee] hover:scale-101 transition-all rounded-2xl p-4 w-full shadow-xl h-70">
    <h3 class="font-semibold text-xl mb-4">Pedidos recientes</h3>

    <?php if ($orders): ?>
        <ul class="text-sm space-y-2 text-left">
            <?php foreach ($orders as $order): ?>
                <li class="flex justify-between border-b py-2">
                    <div>
                        <span>Pedido #<?= $order['order_id'] ?></span><br>
                        <span class="text-gray-500 text-xs">
                            <?= htmlspecialchars($order['street'] . ' ' . $order['floor'] . ', ' . $order['zipcode'] . ' ' . $order['city']) ?>
                        </span>
                    </div>
                    <div class="text-right">
                        <span class="font-semibold"><?= number_format($order['total_price'], 2) ?> €</span><br>
                        <span class="text-blue-500 text-xs"><?= htmlspecialchars($order['payment_method']) ?></span>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <button onclick="window.location.href='/student002/shop/backend/customer_pages/my_orders.php'" class="buttons p-2 w-full mt-4">Ver todo</button>

    <?php else: ?>
        <p>No hay pedidos.</p>
    <?php endif; ?>
</div>
