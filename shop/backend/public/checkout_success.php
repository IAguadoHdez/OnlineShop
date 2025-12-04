<?php
require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/header.php';

// Asegurarnos de que el usuario esté logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: /student002/shop/backend/login.php");
    exit;
}
?>

<main class="h-[calc(100vh-200px)] bg-background text-texto py-12 flex justify-center items-center">
    <div class="w-full  h-80 max-w-md bg-[#eeeeee] p-6 rounded-xl shadow-xl text-center">
        <h2 class="text-3xl font-bold mb-6 text-call-to-action">Pedido realizado correctamente!</h2>
        <p class="mb-6">Gracias por tu compra. Tu compra esta siendo procesada</p>

        <a href="/student002/shop/index.html" class="buttons w-full block mb-4">Volver a inicio</a>
        <a href="/student002/shop/backend/shopping_cart.php" class="links block text-sm text-texto-secundario">Ver
            carrito</a>
    </div>
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/footer.php'; ?>