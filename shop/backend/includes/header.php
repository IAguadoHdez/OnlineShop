<?php session_start(); ?>
<?php $name = $_SESSION['user_name'] ?? 'Guest'; ?>
<?php $role = $_SESSION['role'] ?? null; ?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Panel de administración</title>
  <link rel="stylesheet" href="/student002/shop/css/output.css">
  <link rel="shortcut icon" href="/student002/shop/assets/images/logo.png" type="image/x-icon">
  <script src="https://kit.fontawesome.com/46652c82d3.js" crossorigin="anonymous"></script>
</head>

<body class="bg-texto text-background min-h-screen font-sans">
  <nav
    class="p-4 border-b border-textoSecundario flex flex-col md:flex-row justify-between items-center gap-4 md:gap-0">

    <div class="flex items-center">
      <a href="/student002/shop/backend/public/index.php" class="flex items-center">
        <img src="\student002\shop\assets\images\logo.png" alt="Logo" class="w-[60px] mr-2">
      </a>
      <span class="text-background font-semibold flex items-center gap-2 text-xl">
        <?php
        echo $name;
        if (!$_SESSION) {
          echo ' no ha iniciado sesión';
          echo "<a href='/student002/shop/backend/public/login.php'> <button class='fa-solid fa-arrow-right-to-bracket cursor-pointer icono'></button></a>";
        } else if ($_SESSION) {
          echo "<i class='fa-regular fa-user icono'></i>";

          include $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/public/logout.php';
        }
        ?>
      </span>
    </div>

    <div class="flex flex-wrap gap-5 items-center justify-center text-xl">

      <div class="flex gap-4">

        <a href="/student002/shop/index.html" class="links">Volver a tienda </a>
        <a href="/student002/shop/backend/admin_pages/products.php" class="links"> Productos </a>

        <?php if ($role === 'admin'): ?>
          <a href="/student002/shop/backend/admin_pages/reviews.php" class="links">Revisar Reviews</a>
          <a href="/student002/shop/backend/admin_pages/customers.php" class="links"> Clientes </a>
          <a href="/student002/shop/backend/admin_pages/orders.php" class="links"> Pedidos </a>
        <?php endif; ?>

        <?php if ($role === 'customer' || $role === 'admin'): ?>
          <a href="/student002/shop/backend/customer_pages/myprofile.php" class="links"> Mi perfil </a>
        <?php endif; ?>
        <?php if ($role === 'customer' || $role === 'admin'): ?>
          <a href="/student002/shop/backend/customer_pages/my_orders.php" class="links"> Mis pedidos </a>
        <?php endif; ?>


      </div>
      <?php
      if ($role === 'customer' || $role === 'admin') {
        echo "<div>
                  <a href='/student002/shop/backend/public/shopping_cart.php'>
                    <button type='submit'class='icono fa-solid fa-cart-shopping fa-xl cursor-pointer hover:text-accent'></button>
                  </a>
                  </div>";
      }
      ?>
    </div>
  </nav>