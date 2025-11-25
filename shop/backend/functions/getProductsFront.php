<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';

$q = isset($_GET['q']) ? $_GET['q'] : '';

if ($q !== "") {
    $q = strtolower($q);
    $stmt = $conn->prepare("SELECT * FROM 002products WHERE LOWER(product_name) LIKE ?");
    $likeQ = "%$q%";
    $stmt->bind_param("s", $likeQ);
} else {
    $stmt = $conn->prepare("SELECT * FROM 002products");
}

$stmt->execute();
$result = $stmt->get_result();
$productos = $result->fetch_all(MYSQLI_ASSOC);

// Mostrar en frontend con estilo 'product-card'
if (count($productos) > 0) {
    foreach ($productos as $p) {
        echo "<div class='product-card'>";
        echo "  <div class='product-image'>";
        echo "    <a href='./views/productDetail.html'><img src='{$p['product_image']}' alt='{$p['product_name']}'></a>";
        echo "  </div>";
        echo "  <div class='product-info'>";
        echo "    <h3 class='product-title'>{$p['product_name']}</h3>";
        echo "    <div class='product-footer'>";
        echo "      <span class='product-price'>€{$p['product_price']}</span>";
        echo "      <i class='fa-solid fa-cart-plus fa-xl'></i>";
        echo "    </div>";
        echo "  </div>";
        echo "</div>";
    }
} else {
    echo "<p>No se encontraron productos.</p>";
}

$stmt->close();
$conn->close();
?>
