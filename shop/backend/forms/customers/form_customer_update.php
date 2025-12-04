<?php
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/config/db_connection.php';
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/db/customers/db_customer_update.php';

$id = $_POST['customer_id'] ?? $_GET['customer_id'] ?? null;

if (!$id) {
    die("ID no válido");
}

$customer = getCustomer($id);

// Procesar actualización al hacer submit
if (isset($_POST['update'])) {
    $ok = updateCustomer(
        $id,
        $_POST['customer_name'],
        $_POST['lastname'],
        $_POST['email'],
        $_POST['phone']
    );

    if ($ok) {
        header("Location: /student002/shop/backend/admin_pages/customers.php?msg=updated");
        exit;
    }
}
?>


<main class="bg-background h-screen flex justify-center items-center text-texto ">
    <div
        class="bg-[#eeeeee] p-8 rounded-xl shadow-lg text-center max-w-md w-full border border-textoSecundario/50 max-h-150">
        <h2 class="text-2xl font-bold text-texto mb-6">Actualizar cliente <span class="text-accent"><?= $id ?></span>
        </h2>

        <form method="POST" class="flex flex-col gap-4 text-left">
            <input type="hidden" name="customer_id" value="<?= $id ?>">

            <div>
                <label>Nombre</label>
                <input type="text" name="customer_name" value="<?= htmlspecialchars($customer['customer_name']) ?>"
                    class="inputs">
            </div>

            <div>
                <label>Apellido</label>
                <input type="text" name="lastname" value="<?= htmlspecialchars($customer['lastname']) ?>"
                    class="inputs">
            </div>

            <div>
                <label>Email</label>
                <input type="text" name="email" value="<?= htmlspecialchars($customer['email']) ?>" class="inputs">
            </div>

            <div>
                <label>Teléfono</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($customer['phone']) ?>" class="inputs">
            </div>

            <button type="submit" name="update" class="buttons">Guardar cambios</button>
        </form>


        <a href="/student002/shop/backend/admin_pages/customers.php"
            class="links block mt-6 text-sm text-textoSecundario">
            ← Volver atrás
        </a>
    </div>
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/footer.php'; ?>