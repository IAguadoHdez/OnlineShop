<?php
session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/db/customers/db_customer_insert.php';

require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/header.php';

$customerInsertado = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $customerInsertado = insertarCustomer(
        $_POST['customer_name'],
        $_POST['customer_lastname'],
        $_POST['email'],
        $_POST['phone']
    );
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Cliente</title>
</head>
<body class="bg-[#0D0D0D] font-sans">

<div class="fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-[#1A1A1A] p-10 rounded-2xl shadow-2xl text-center max-w-md w-full border border-[#737373]/30">

        <?php if ($customerInsertado === true) { ?>
            <h1 class="text-2xl font-bold mb-6 text-[#F5F5F5]">Cliente insertado</h1>
            <p class="mb-8 text-[#F5F5F5]">
                El cliente <span class="text-[#00C4CC] font-semibold"><?= htmlspecialchars($_POST['customer_name']) ?> <?= htmlspecialchars($_POST['customer_lastname']) ?></span> se ha insertado correctamente.
            </p>
        <?php } ?>

        <?php if ($customerInsertado === false) { ?>
            <h1 class="text-2xl font-bold mb-6 text-[#F5F5F5]">Error al insertar</h1>
            <p class="mb-8 text-[#F5F5F5]">
                No se pudo insertar el cliente. Revisa los datos y vuelve a intentarlo.
            </p>
        <?php } ?>

        <?php if ($customerInsertado === null) { ?>
            <h1 class="text-2xl font-bold mb-6 text-[#F5F5F5]">Insertar Cliente</h1>
            <form method="POST" class="flex flex-col items-center space-y-4">
                <input type="text" name="customer_name" placeholder="Nombre" required class="w-64 p-2 rounded-xl border border-[#737373] text-[#0D0D0D] focus:outline-none focus:ring-2 focus:ring-[#00C4CC]">
                <input type="text" name="customer_lastname" placeholder="Apellido" required class="w-64 p-2 rounded-xl border border-[#737373] text-[#0D0D0D] focus:outline-none focus:ring-2 focus:ring-[#00C4CC]">
                <input type="email" name="email" placeholder="Correo electrónico" required class="w-64 p-2 rounded-xl border border-[#737373] text-[#0D0D0D] focus:outline-none focus:ring-2 focus:ring-[#00C4CC]">
                <input type="text" name="phone" placeholder="Teléfono" required class="w-64 p-2 rounded-xl border border-[#737373] text-[#0D0D0D] focus:outline-none focus:ring-2 focus:ring-[#00C4CC]">
                <input type="submit" value="Insertar" class="w-64 bg-[#FF4D00] text-[#F5F5F5] py-2 rounded-xl font-bold cursor-pointer hover:bg-[#00C4CC] hover:text-[#0D0D0D] transition-all duration-200">
            </form>
        <?php } ?>

        <a href="../../index.php" class="block mt-6 text-sm text-[#737373] hover:text-[#00C4CC] transition">← Volver al inicio</a>
    </div>
</div>

</body>
</html>
