<?php
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';

// Traer reviews pendientes
$stmt = $conn->prepare("SELECT * FROM 002reviews WHERE status = 'pending' ORDER BY created_at DESC");
$stmt->execute();
$result = $stmt->get_result();
$reviews = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<main class="min-h-screen bg-background text-texto p-6">
    <div>
      <h1 class="text-3xl font-bold mb-6 text-center"><i class="fa-solid fa-inbox"></i> Revisar Reviews</h1>
    </div>


  <div id="reviews-container" class="flex gap-5 flex-wrap">

  <?php if ($reviews) {
    foreach ($reviews as $review) {

      echo '<div class="bg-[#eeeeee] p-4 rounded-xl shadow-lg w-72">';
      echo '<div class="flex justify-between mb-2">';
      echo '<span class="font-semibold">Review #' . $review['review_id'] . '</span>';
      echo '<span class="text-texto">' . date("d/m/Y", strtotime($review['created_at'])) . '</span>';
      echo '</div>';

      echo '<p class="mb-2 text-sm">Usuario: ' . htmlspecialchars($review['customer_id']) . '</p>';
      echo '<p class="mb-2 text-sm font-semibold">' . htmlspecialchars($review['mark']) . ' <i class="fa-solid fa-star text-yellow-400"></i></p>';
      echo '<p class="mb-4 text-sm">' . nl2br(htmlspecialchars($review['comment'])) . '</p>';

      echo '<div class="flex justify-between">';
      
      echo '<form action="/student002/shop/backend/db/reviews/db_review_approve.php" method="POST">';
      echo '<input type="hidden" name="id" value="' . $review['review_id'] . '">';
      echo '<button class="buttons p-2"><i class="fa-solid fa-check"></i> Aprobar</button>';
      echo '</form>';

      echo '<form action="/student002/shop/backend/db/reviews/db_review_reject.php" method="POST">';
      echo '<input type="hidden" name="id" value="' . $review['review_id'] . '">';
      echo '<button class="buttons p-2"><i class="fa-solid fa-x"></i> Rechazar</button>';
      echo '</form>';

      echo '</div>';
      echo '</div>';
    }
  } else {
    echo '<p class="font-bold text-xl">No hay reviews pendientes.</p>';
  } ?>

  </div>
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/footer.php'; ?>
