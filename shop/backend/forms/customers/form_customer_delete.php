<?php
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/db/customers/db_customer_delete.php';

$id = $_POST['customer_id'] ?? null;
$confirmado = $_POST['confirmar'] ?? null;
$clienteEliminado = ($id && $confirmado) ? eliminarCliente($id) : null;
?>
<main class="flex h-[calc(100vh-160px)] justify-center items-center bg-background">
    <div class="bg-[#eeeeee] rounded-2xl p-10 h- shadow-2xl  text-center border border-textoSecundario/30">

        <?php if (!$confirmado): ?>
            <h1 class="text-2xl font-bold mb-6 text-texto">Confirmar eliminación</h1>
            <p class="mb-8 text-texto">
                ¿Seguro que quieres borrar el cliente con ID
                <span class="text-accent font-semibold"><?= $id ?></span>?
            </p>

            <form method="POST" class="flex justify-center gap-4">
                <input type="hidden" name="customer_id" value="<?= $id ?>">
                <button type="submit" name="confirmar" value="1" class="buttons w-[100px]">Aceptar</button>
                <a href="/student002/shop/backend/admin_pages/customers.php"
                    class="buttons bg-callToAction w-[100px] text-center pt-2">Cancelar</a>
            </form>

        <?php else: ?>

            <?php if ($clienteEliminado): ?>
                <h1 class="text-2xl font-bold mb-6 text-texto">Cliente eliminado</h1>
                <p class="mb-8 text-[#F5F5F5]">
                    El cliente con ID <span class="text-callToAction font-semibold"><?= $id ?></span> fue eliminado
                    correctamente.
                </p>
            <?php endif; ?>
            <a href="/student002/shop/backend/public/index.php" class="links">← Volver
                al inicio</a>
        <?php endif; ?>
    </div>
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/footer.php'; ?>