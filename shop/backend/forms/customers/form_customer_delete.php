<?php
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/db/customers/db_customer_delete.php';

$id = $_POST['customer_id'] ?? null;
$confirmado = $_POST['confirmar'] ?? null;
$clienteEliminado = ($id && $confirmado) ? eliminarCliente($id) : null;
?>

<div
    class="bg-[#1A1A1A] p-10 rounded-2xl shadow-2xl text-center max-w-md w-full mx-auto border border-textoSecundario/30">

    <?php if (!$confirmado): ?>
        <h1 class="text-2xl font-bold mb-6 text-[#F5F5F5]">Confirmar eliminación</h1>
        <p class="mb-8 text-[#F5F5F5]">
            ¿Seguro que quieres borrar el cliente con ID
            <span class="text-[#00C4CC] font-semibold"><?= $id ?></span>?
        </p>

        <form method="POST" class="flex justify-center gap-4">
            <input type="hidden" name="customer_id" value="<?= $id ?>">
            <button type="submit" name="confirmar" value="1" class="buttons w-[100px]">Aceptar</button>
            <a href="/student002/shop/backend/admin_pages/customers.php"
                class="buttons bg-callToAction w-[100px] text-center pt-2">Cancelar</a>
        </form>

    <?php else: ?>

        <?php if ($clienteEliminado): ?>
            <h1 class="text-2xl font-bold mb-6 text-[#F5F5F5]">Cliente eliminado</h1>
            <p class="mb-8 text-[#F5F5F5]">
                El cliente con ID <span class="text-[#00C4CC] font-semibold"><?= $id ?></span> fue eliminado correctamente.
            </p>
        <?php endif; ?>
        <a href="/student002/shop/backend/public/index.php" class="block mt-6 text-sm text-textoSecundario hover:text-[#00C4CC] transition">← Volver
            al inicio</a>
    <?php endif; ?>
</div>