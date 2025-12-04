<?php
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';

if (!isset($_SESSION['user_id'])) {
    die("Debes iniciar sesión.");
}

$customer_id = $_SESSION['user_id'];

/* OBTENER PEDIDOS DEL CLIENTE */
$stmt = $conn->prepare("
    SELECT 
        o.order_id, o.placed_on,
        p.product_id, p.product_name, p.product_price
    FROM 002orders o
    JOIN 002products p ON o.product_id = p.product_id
    WHERE o.customer_id = ?
    ORDER BY o.placed_on DESC
");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result_orders = $stmt->get_result();
$orders = $result_orders->fetch_all(MYSQLI_ASSOC);
?>

<h1>Mis pedidos</h1>

<?php
if (count($orders) === 0) {
    echo "<p>No tienes pedidos aún.</p>";
}

foreach ($orders as $order):
    // Verificar si ya existe reseña
    $check_stmt = $conn->prepare("
        SELECT review_id FROM 002reviews
        WHERE customer_id = ? AND product_id = ?
    ");
    $check_stmt->bind_param("ii", $customer_id, $order['product_id']);
    $check_stmt->execute();
    $reviewCheck = $check_stmt->get_result();
    $alreadyReviewed = $reviewCheck->num_rows > 0;
    ?>
    <main class="bg-background">
        <div class="order-box bg-[#eeeeee] shadow-md rounded-xl p-6 mb-6 border border-gray-200">

            <p class="text-lg font-semibold text-texto">
                Pedido #<?= htmlspecialchars($order['order_id']) ?>
                <span class="text-sm text-textoSecundario ml-2">— <?= htmlspecialchars($order['placed_on']) ?></span>
            </p>

            <p class="text-texto mt-2 text-base">
                <span class="font-medium"><?= htmlspecialchars($order['product_name']) ?></span>
                — <span class="text-accent font-bold"><?= htmlspecialchars($order['product_price']) ?> €</span>
            </p>

            <?php if (!$alreadyReviewed): ?>
                <form method="POST" action="/student002/shop/backend/db/db_reviews.php"
                    class="review-form mt-4 space-y-4 text-texto">
                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($order['product_id']) ?>">
                    <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['order_id']) ?>">

                    <!-- Rating de valoración -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Valoración</label>
                        <select name="rating" required
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Selecciona una valoración</option>
                            <option value="1">1 - Muy malo</option>
                            <option value="2">2 - Malo</option>
                            <option value="3">3 - Regular</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>

                    <!-- Comentario del cliente -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Comentario</label>
                        <textarea name="comment" rows="3" required
                            class="w-full border border-gray-300 rounded-lg p-3 resize-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Escribe tu opinión sobre el producto..."></textarea>
                    </div>
                    <button type="submit" class="buttons w-[200px]">Enviar reseña</button>
                </form>
            <?php else: ?>
                <p class="text-texto font-medium mt-4 flex items-center">
                    <i class="icono fa-solid fa-check"></i> Ya has completado una reseña de este producto.
                </p>
            <?php endif; ?>
        </div>
    </main>
<?php endforeach; ?>