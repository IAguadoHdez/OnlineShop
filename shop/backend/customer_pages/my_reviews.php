<?php
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';
$id = $_SESSION['user_id'] ?? null;


// RECUPERAR PRODUCTOS SIN REVIEW DE MI CLIENTE
$productos = [];
if ($id) {
  $query = $conn->prepare("
    SELECT p.product_id, p.product_name
    FROM `002orders` o
    INNER JOIN `002products` p ON o.product_id = p.product_id
    WHERE o.customer_id = ?
    AND NOT EXISTS (
        SELECT 1 FROM `002reviews` r 
        WHERE r.product_id = o.product_id AND r.customer_id = o.customer_id
    )
");


  $query->bind_param("i", $id);
  $query->execute();
  $result = $query->get_result();

  while ($row = $result->fetch_assoc()) {
    $productos[] = $row;
  }

  $query->close();
}

// RECUPERAR REVIEWS REALIZADAS DEPENDE DEL CLIENTE
$reviews = [];
if ($id) {
  $query2 = $conn->prepare("
    SELECT p.product_id, p.product_name, r.comment, r.mark
    FROM `002reviews` r 
    INNER JOIN `002products` p ON r.product_id = p.product_id 
    WHERE r.customer_id = ?
");
  $query2->bind_param("i", $id);
  $query2->execute();
  $result2 = $query2->get_result();

  while ($row2 = $result2->fetch_assoc()) {
    $reviews[] = $row2;
  }
  $query2->close();

}


function renderStars($rating)
{
  $stars = "";
  for ($i = 1; $i <= 5; $i++) {
    if ($i <= $rating) {
      $stars .= '<i class="fa-solid fa-star filled"></i>';
    } else {
      $stars .= '<i class="fa-regular fa-star"></i>';
    }
  }
  return $stars;
}


?>

<style>
  input[type="radio"] {
    display: none;
  }

  i.fa-star {
    font-size: 1.3rem;
    color: var(--color-texto);
    cursor: pointer;
    transition: color 0.1s;
  }

  i.fa-star.filled {
    color: gold;
  }
</style>

<main class="bg-[#eeeeee] min-h-screen">
  <div class="flex gap-10 p-10">
    <?php foreach ($productos as $producto): ?>
      <form class="bg-background text-texto p-4 w-[400px] shadow-xl rounded-xl " method="POST"
        action="/student002/shop/backend/db/reviews/db_reviews_insert.php">
        <input type="hidden" name="product_id" value="<?= $producto['product_id'] ?>">
        <h2 class="text-xl font-semibold mb-2"><?= htmlspecialchars($producto['product_name']) ?></h2>
        <div class="stars mb-3">
          <?php for ($i = 1; $i <= 5; $i++): ?>
            <label>
              <input type="radio" name="mark" value="<?= $i ?>" required>
              <i class="fa-regular fa-star"></i>
            </label>
          <?php endfor; ?>
        </div>
        <textarea name="comment" class="w-full border p-2" placeholder="Escribe tu opinión"></textarea>
        <button type="submit" class="mt-3 buttons w-[200px]">Enviar review</button>
      </form>
    <?php endforeach ?>
  </div>

  <div class=" flex flex-col gap-10 items-center justify-center text-texto">
    <div class="bg-background p-2 shadow-xl rounded-xl">
      <h2 class="text-2xl font-semibold">Reseñas realizadas</h2>
    </div>
    <div class="flex gap-4 justify-center">
      <?php foreach ($reviews as $review): ?>
        <div class="bg-background w-[350px] shadow-xl rounded-xl p-4 flex flex-col gap-2 hover:scale-101 transition-all">
          <h2 class="text-xl font-semibold"><?= htmlspecialchars($review['product_name']) ?></h2>
          <p class="text-xl flex items-center gap-1">
            <?= renderStars($review['mark']) ?>
            <span class="text-accent ">(<?= htmlspecialchars($review['mark']) ?>/5)</span>
          </p>

          <div class="border rounded p-2">
            <p><?= htmlspecialchars($review['comment']) ?></p>
          </div>

        </div>
      <?php endforeach; ?>
    </div>
  </div>
</main>

<!-- SCRIPT JS (COLORES ESTRELLAS) -->
<script>
  document.querySelectorAll('form').forEach(form => {
    const stars = form.querySelectorAll('.stars i');
    const radios = form.querySelectorAll('.stars input[type="radio"]');
    let selectedRating = -1;

    stars.forEach((star, idx) => {
      // Hover: color temporal
      star.addEventListener('mouseover', () => {
        clearStars();
        for (let i = 0; i <= idx; i++) {
          stars[i].classList.add('filled');
        }
      });

      // Mouseout: restaurar selección
      star.addEventListener('mouseout', () => {
        clearStars();
        if (selectedRating >= 0) {
          for (let i = 0; i <= selectedRating; i++) {
            stars[i].classList.add('filled');
          }
        }
      });

      // Click: guardar rating y cambiar icono a sólido
      star.addEventListener('click', () => {
        selectedRating = idx;
        radios[idx].checked = true;

        // Primero revertimos todas a regular
        stars.forEach(s => {
          s.classList.remove('fa-solid');
          s.classList.add('fa-regular');
        });

        // Luego ponemos sólidas las seleccionadas
        for (let i = 0; i <= idx; i++) {
          stars[i].classList.remove('fa-regular');
          stars[i].classList.add('fa-solid');
        }
      });
    });

    function clearStars() {
      stars.forEach(s => s.classList.remove('filled'));
    }
  });
</script>