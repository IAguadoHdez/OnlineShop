<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/header.php'; ?>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/db/products/db_product_update.php'; ?>

<?php

$id = $_POST['product_id'] ?? null;
$producto = obtenerProducto($id);
$mensaje = '';
$productoActualizado = null;
if (!empty($_POST['update']) && $producto) {

    $nombre = $_POST['product_name'];
    $precio = $_POST['product_price'];
    $quantity = $_POST['quantity'];
    $categoria = $_POST['categories'];
    $img = $producto['product_image'];

    if (actualizarProducto($id, $nombre, $precio, $quantity, $categoria, $img)) {
        $mensaje = "Producto actualizado correctamente.";
        $producto = obtenerProducto($id);
        $productoActualizado = true;
    } else {
        $mensaje = "Error al actualizar.";

    }
}


?>
<main class="bg-background h-screen flex justify-center items-center">
    <div
        class="bg-[#eeeeee] p-8 rounded-xl shadow-lg text-center max-w-md w-full border border-textoSecundario/30 max-h-150">
        <?php if ($productoActualizado === true): ?>
            <h1 class="text-2xl font-bold mb-6 text-texto">Producto insertado</h1>
            <p class="mb-8 text-accent">
                El producto se ha actualizado correctamente.
            </p>
        <?php endif; ?>
        <h2 class="text-2xl font-bold text-texto mb-6">Actualizar producto ID <span
                class="text-accent"><?= $id ?></span></h2>

        <form method="POST" class="flex flex-col gap-4">
            <input type="hidden" name="product_id" value="<?= $id ?>">

            <label class="text-texto text-left">Nombre:</label>
            <input type="text" name="product_name" value="<?= $producto['product_name'] ?>" required class="inputs">

            <label class="text-texto text-left">Precio:</label>
            <input type="number" step="0.01" name="product_price" value="<?= $producto['product_price'] ?>" required
                class="inputs">

            <label class="text-texto text-left">Stock:</label>
            <input type="number" name="quantity" value="<?= $producto['quantity'] ?>" required class="inputs">

            <label class="text-texto text-left">Categoría:</label>
            <input type="text" name="categories" value="<?= $producto['category_id'] ?>" required class="inputs">

            <button type="submit" name="update" value="1" class="buttons">Guardar </button>
        </form>

        <a href="/student002/shop/backend/admin_pages/products.php"
            class="links block mt-6 text-sm text-textoSecundario ">← Volver atras</a>
    </div>
</main>