<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/header.php'; ?>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/db/db_product_insert.php'; ?>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/db/db_insert_image.php'; ?>

<?php 
$productoInsertado = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $imagePath = null;
    if (isset($_FILES['product_image'])) {
        $imagePath = subirImagenPNG($_FILES['product_image']);
    }

    if ($imagePath) {
        $productoInsertado = insertarProducto(
            $_POST['product_name'],
            $_POST['product_price'],
            $_POST['stock'],
            $_POST['category_id'],
            $imagePath
        );
    } else {
        $productoInsertado = false;
    }
}
?>

<div class="fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-[#1A1A1A] p-10 rounded-2xl shadow-2xl text-center max-w-md w-full border border-textoSecundario/30">

        <?php if ($productoInsertado === true): ?>
            <h1 class="text-2xl font-bold mb-6 text-texto">Producto insertado</h1>
            <p class="mb-8 text-texto">
                El producto <span class="text-accent font-semibold"><?= ($_POST['product_name']) ?></span> se ha insertado correctamente.
            </p>
        <?php endif; ?>

        <h1 class="text-2xl font-bold mb-6 text-texto">Insertar Producto</h1>
        <form method="POST" enctype="multipart/form-data" class="flex flex-col items-center space-y-4">
            <input type="text" name="product_name" placeholder="Nombre del producto" required class="inputs">
            <input type="text" name="product_price" placeholder="Precio del producto" required class="inputs">
            <input type="number" name="stock" placeholder="Cantidad" required class="inputs">
            <input type="number" name="category_id" placeholder="ID de la categoría" required class="inputs">
            <button type="submit" value="Insertar" class="buttons w-full">Insertar</button>
        </form>

        <a href="../../products.php" class="block mt-6 text-sm text-textoSecundario hover:text-accent transition">← Volver al inicio</a>
    </div>
</div>
