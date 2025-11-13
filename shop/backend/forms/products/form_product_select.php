<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/db/db_connection.php'; 

$sql = 'SELECT * 
            FROM products';

$result = mysqli_query($connection, $sql);

$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

foreach ($products as $product) {
    echo "<p class='p-2'>" . 'ID' . ' | ' . 'Nombre Producto' . ' | ' . 'Precio' . ' | ' . 'Stock' . ' | ' . 'Categoria' . "</p>";
    echo '<p class="p-2">' . $product['product_id'] . ' | ' . $product['product_name'] . ' | ' . $product['product_price'] . ' | ' . $product['stock'] . ' | ' . $product['category_id'] . '</p>';
    echo '<hr class="mb-2">';
}

?>
    <a href="../../index.php" class="block mt-6 text-sm text-textoSecundario hover:text-accent transition ml-5 f">← Volver al inicio</a>