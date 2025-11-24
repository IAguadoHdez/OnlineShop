<?php session_start(); ?>
<?php $name = $_SESSION['user_name'] ?? 'Guest'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Panel de administración</title>
  <link rel="stylesheet" href="/student002/shop/css/output.css">
  <script src="https://kit.fontawesome.com/46652c82d3.js" crossorigin="anonymous"></script>
</head>

<body class="bg-texto text-background min-h-screen font-sans">
  <nav
    class="p-4 border-b border-textoSecundario flex flex-col md:flex-row justify-between items-center gap-4 md:gap-0">

    <div class="flex items-center">
      <a href="\student002\shop\backend\index.php" class="flex items-center">
        <img src="\student002\shop\assets\images\logo.png" alt="Logo" class="w-[60px] mr-2">
      </a>
      <span class="text-background font-semibold flex items-center gap-2 text-xl">
        <?php
        echo $name;
        if (!$_SESSION) {
          echo ' no ha iniciado sesión';
          echo "<a href='/student002/shop/backend/login.php'> <button class='fa-solid fa-arrow-right-to-bracket cursor-pointer icono'></button></a>";
        } else if ($_SESSION) {
          echo "<a href='/student002/shop/backend/myprofile.php'>
            <button class='fa-regular fa-user icono'></button>
          </a>";

          include("logout.php");
        }
        ?>
      </span>
    </div>

    <div class="flex flex-wrap gap-5 items-center justify-center text-xl">

      <div class="flex gap-4">
        <a href="../index.html" class="links">Homepage </a>
        <a href="/student002/shop/backend/products.php" class="links"> Productos </a>
        <a href="/student002/shop/backend/customers.php" class="links"> Clientes </a>
        <a href="/student002/shop/backend/orders.php" class="links">Pedidos</a>
      </div>
      <?php
      if ($_SESSION) {
        echo "<div>
                <a href='/student002/shop/backend/shopping_cart.php'>
                  <button type='submit'class='icono fa-solid fa-cart-shopping fa-xl cursor-pointer hover:text-accent'></button>
                </a>
                </div>";
      }
      ?>
    </div>
  </nav>