<?php
$id = $_SESSION['user_id'] ?? null;
if (!$id) {
  header("Location: /student002/shop/backend/login.php");
  exit;
}
$mensaje = "No hay novedades";

if ($id) {
  // Consultar productos comprados que aún no tienen review del cliente actual
  $query = $conn->prepare("
        SELECT p.product_id, p.product_name
        FROM `002orders` o
        INNER JOIN `002products` p ON o.product_id = p.product_id
        LEFT JOIN `002reviews` r 
            ON r.product_id = o.product_id AND r.customer_id = o.customer_id
        WHERE o.customer_id = ? AND r.review_id IS NULL
    ");

  $query->bind_param("i", $id);
  $query->execute();
  $result = $query->get_result();

  $pendientes = $result->num_rows;

  if ($pendientes > 0) {
    $mensaje = "Tienes reseñas pendientes";
  }
  $query->close();
}
?>

<div class="flex flex-col bg-[#eeeeee] shadow-2xl rounded-2xl p-4 w-full  h-70 text-center items-center gap-5">
  <h2 class="text-xl font-semibold">Mis reseñas</h2>
  <div class="flex items-center gap-2">
    <a href="/student002/shop/backend/customer_pages/my_reviews.php">
      <button
        class=" text-cetner w-6 h-6 rounded-full text-background bg-accent font-bold text-xl flex items-center justify-center hover:scale-150 transition-all cursor-pointer">!</button>
    </a>
    <p class="font-semibold"><?= htmlspecialchars($mensaje) ?></p>
  </div>
  <a href="/student002/shop/backend/customer_pages/my_reviews.php" class="w-full"><button class="buttons w-full">Ver
      reseñas</button></a>
</div>