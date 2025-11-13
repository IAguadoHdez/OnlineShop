<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/header.php'; ?>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/db/db_product_update.php'; ?>

<?php 
$id = $_POST['product_id'] ?? null;
$producto = obtenerProducto($id);
$mensaje = '';

$campos = [
    'product_name' => '',
    'product_price' => 0,
    'stock' => 0,
    'categories' => '',
    'product_image' => ''
];

// Actualizar producto si el producto existe
if (!empty($_POST['update']) && $producto) {
    foreach ($campos as $key => &$valor) {
        $valor = $_POST[$key] ?? $valor;
    }
    unset($valor);
    
}
?>
<div class="bg-[#1A1A1A] p-8 rounded-xl shadow-lg text-center max-w-md w-full border border-textoSecundario/30 mx-auto my-8">
    <h2 class="text-2xl font-bold text-texto mb-6">Actualizar producto ID <?= $id ?></h2>

    <form method="POST" class="flex flex-col gap-4">
        <input type="hidden" name="product_id" value="<?= $id ?>">

        <label class="text-texto text-left">Nombre:</label>
        <input type="text" name="product_name" value="<?= $producto['product_name'] ?>" required class="inputs">

        <label class="text-texto text-left">Precio:</label>
        <input type="number" step="0.01" name="product_price" value="<?= $producto['product_price'] ?>" required class="inputs">

        <label class="text-texto text-left">Stock:</label>
        <input type="number" name="stock" value="<?= $producto['stock'] ?>" required class="inputs">

        <label class="text-texto text-left">Categoría:</label>
        <input type="text" name="categories" value="<?= $producto['category_id'] ?>" required class="inputs">

        <button type="submit" name="update" class="buttons">Guardar </button>
    </form>

    <a href="../../products.php" class="links block mt-6 text-sm text-textoSecundario ">← Volver atras</a>
</div>