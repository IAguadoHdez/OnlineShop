<?php
include  __DIR__ . '/../../db/db_product_update.php';
include __DIR__ . '/../../header.php';


$id_producto = $_POST['product_id'] ?? null;
$mensaje = '';
$producto = null;

if ($id_producto) {

    $producto = obtenerProducto($id_producto);

    if (!$producto) {
        $mensaje = "No se encontró el producto.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update']) && $producto) {
    $nombre = $_POST['product_name'] ?? '';
    $precio = $_POST['product_price'] ?? 0;
    $stock = $_POST['stock'] ?? 0;
    $categoria = $_POST['categories'] ?? '';

    $exito = actualizarProducto($id_producto, $nombre, $precio, $stock, $categoria);

    if ($exito) {
        $mensaje = "Producto actualizado correctamente.";
    } else {
        $mensaje = "Error al actualizar el producto.";
    }
    $producto = obtenerProducto($id_producto);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar producto</title>
</head>
<body class="bg-[#0D0D0D] flex items-center justify-center font-sans">

<div class="bg-[#1A1A1A] p-8 rounded-xl shadow-lg text-center max-w-md w-full border border-[#737373]/30 mx-auto ">
    <h2 class="text-2xl font-bold text-[#F5F5F5] mb-6">Actualizar producto ID <?= htmlspecialchars($id_producto) ?></h2>

    <?php if ($mensaje): ?>
        <p class="text-[#00C4CC] mb-4"><?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>

    <?php if ($producto): ?>
    <form method="POST" class="flex flex-col gap-4">
        <input type="hidden" name="product_id" value="<?= htmlspecialchars($id_producto) ?>">

        <label class="text-[#F5F5F5] text-left">Nombre:</label>
        <input type="text" name="product_name" value="<?= htmlspecialchars($producto['product_name']) ?>" required class="p-2 rounded-lg border border-[#737373] bg-[#0D0D0D] text-[#F5F5F5]">

        <label class="text-[#F5F5F5] text-left">Precio:</label>
        <input type="number" step="0.01" name="product_price" value="<?= $producto['product_price'] ?>" required class="p-2 rounded-lg border border-[#737373] bg-[#0D0D0D] text-[#F5F5F5]">

        <label class="text-[#F5F5F5] text-left">Stock:</label>
        <input type="number" name="stock" value="<?= $producto['stock'] ?>" required class="p-2 rounded-lg border border-[#737373] bg-[#0D0D0D] text-[#F5F5F5]">

        <label class="text-[#F5F5F5] text-left">Categoría:</label>
        <input type="text" name="categories" value="<?= htmlspecialchars($producto['category_id']) ?>" required class="p-2 rounded-lg border border-[#737373] bg-[#0D0D0D] text-[#F5F5F5]">

        <button type="submit" name="update" class="bg-[#FF4D00] text-[#F5F5F5] px-6 py-2 rounded-lg font-bold hover:bg-[#00C4CC] hover:text-[#0D0D0D] transition">
            Guardar
        </button>
    </form>
    <?php endif; ?>

    <a href="../../index.php" class="block mt-6 text-sm text-[#737373] hover:text-[#00C4CC] transition">← Volver al inicio</a>
</div>

</body>
</html>
