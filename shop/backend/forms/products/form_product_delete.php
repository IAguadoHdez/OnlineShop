<?php
session_start();
include __DIR__ . '/../../db/db_product_delete.php';
include __DIR__ . '/../../header.php';

$id = $_POST['product_id'] ?? $_GET['id'] ?? null;
$confirmado = $_POST['confirmar'] ?? null;
$productoEliminado = null;

if ($confirmado && $id) {
    $productoEliminado = eliminarProducto($id);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $productoEliminado ? "Producto eliminado" : "Eliminar producto" ?></title>
</head>
<body class="bg-[#0D0D0D] flex items-center justify-center min-h-screen font-sans">
<div class="bg-[#1A1A1A] p-10 rounded-2xl shadow-2xl text-center max-w-md w-full mx-auto border border-[#737373]/30">

    <?php if ($productoEliminado === true): ?>
        <h1 class="text-2xl font-bold mb-6 text-[#F5F5F5]">Producto eliminado</h1>
        <p class="mb-8 text-[#F5F5F5]">El producto con ID <span class="text-[#00C4CC] font-semibold"><?= htmlspecialchars($id) ?></span> se eliminó correctamente.</p>

    <?php elseif ($id && !$confirmado): ?>
        <h1 class="text-2xl font-bold mb-6 text-[#F5F5F5]">Confirmar eliminación</h1>
        <p class="mb-8 text-[#F5F5F5]">¿Seguro que quieres borrar el producto con ID <span class="text-[#00C4CC] font-semibold"><?= htmlspecialchars($id) ?></span>?</p>

        <form method="POST" class="flex justify-center gap-4">
            <input type="hidden" name="product_id" value="<?= htmlspecialchars($id) ?>">
            <input type="hidden" name="confirmar" value="1">
            <input type="submit" value="Aceptar" class="bg-[#FF4D00] text-[#F5F5F5] px-6 py-2 rounded-xl font-bold hover:bg-[#00C4CC] hover:text-[#0D0D0D] cursor-pointer transition-all duration-200">
            <a href="../../index.php" class="bg-[#737373] text-[#F5F5F5] px-6 py-2 rounded-xl font-bold hover:bg-[#00C4CC] transition-all duration-200 cursor-pointer no-underline">Cancelar</a>
        </form>

    <?php else: ?>
        <h1 class="text-2xl font-bold mb-6 text-[#F5F5F5]">No se pudo eliminar</h1>
        <p class="mb-8 text-[#F5F5F5]">El producto con ID <span class="text-[#00C4CC] font-semibold"><?= htmlspecialchars($id) ?></span> no existe o no se seleccionó correctamente.</p>
    <?php endif; ?>

    <a href="../../index.php" class="block mt-6 text-sm text-[#737373] hover:text-[#00C4CC] transition">← Volver al inicio</a>
</div>
</body>
</html>
