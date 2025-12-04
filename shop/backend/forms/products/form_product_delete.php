<?php
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/db/products/db_product_delete.php';
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/header.php';

$id = $_POST['product_id'];
$confirmado = $_POST['confirmar'] ?? null;
$productoEliminado = ($id && $confirmado) ? eliminarProducto($id) : null;
?>
<main class="flex h-[calc(100vh-84px)] justify-center items-center bg-background">
    <div class="bg-[#eeeeee] rounded-2xl p-10 h- shadow-2xl  text-center border border-textoSecundario/30">

        <h1 class="text-2xl font-bold mb-6 text-texto">
            <?= ($productoEliminado === true) ? "Producto eliminado" : (($id && !$confirmado) ? "Confirmar eliminación" : "No se pudo eliminar") ?>
        </h1>

        <p class="mb-8 text-texto">
            <?= ($productoEliminado === true)
                ? "El producto con ID <span class='text-accent font-semibold'>" . ($id) . "</span> se eliminó correctamente."
                : (($id && !$confirmado)
                    ? "¿Seguro que quieres borrar el producto con ID <span class='text-accent font-semibold'>" . ($id) . "</span>?"
                    : "El producto con ID <span class='text-accent font-semibold'>" . ($id) . "</span> no existe o no se seleccionó correctamente.") ?>
        </p>
        <?= ($id && !$confirmado) ? '
            <form method="POST" class="flex justify-center gap-4">
                <input type="hidden" name="product_id" value="' . ($id) . '">
                <input type="hidden" name="confirmar" value="1">
                <input type="submit" value="Aceptar" class="buttons w-[100px]">
                <a href="../../index.php" class="buttons w-[100px] bg-accent text-background hover:bg-callToAction hover:text-texto">Cancelar</a>
            </form>' : ''
            ?>
        <a href="/student002/shop/backend/admin_pages/products.php"
            class="block mt-6 text-sm text-textoSecundario hover:text-accent transition">←
            Volver atras</a>
    </div>

</main>