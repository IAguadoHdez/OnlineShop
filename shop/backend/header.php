<?php session_start(); ?>
<?php $name = $_SESSION['user_name'] ?? 'Guest'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Panel Administración</title>
  <link rel="stylesheet" href="/student002/shop/css/output.css">
  <script src="https://kit.fontawesome.com/46652c82d3.js" crossorigin="anonymous"></script>
</head>

<body class="bg-background text-texto min-h-screen font-sans">
  <nav class="p-4 border-b border-textoSecundario flex flex-col md:flex-row justify-between items-center gap-4 md:gap-0">

    <div class="flex items-center">
      <a href="\student002\shop\backend\index.php" class="flex items-center">
        <img src="\student002\shop\assets\images\logo.png" alt="Logo" class="w-[60px] mr-2">
      </a>
    </div>

    <div class="flex flex-wrap gap-3 items-center justify-center">
      <span class="text-texto font-semibold flex items-center gap-2">
        <button class="fa-regular fa-user text-callToAction" ></button>
        <?php echo $name; if ($_SESSION) { include("logout.php");}?>
      </span>
      
      <a href="../index.html"> <button class="buttons w-[100px]">Homepage</button> </a>
      <a href="/student002/shop/backend/products.php"> <button class="buttons w-[100px]">Productos</button> </a>
      <a href="/student002/shop/backend/customers.php"> <button class="buttons w-[100px]">Clientes</button> </a>
      <a href="/student002/shop/backend/orders.php"> <button class="buttons w-[100px]">Pedidos</button> </a>

        <?php if(!$_SESSION) {
          echo 'No ha iniciado sesión';
          echo "<a href='/student002/shop/backend/login.php'> <button class='fa-solid fa-arrow-right-to-bracket fa-xl cursor-pointer icono'></button></a>";
        } else {
          echo "<div> <a href='/student002/shop/backend/shopping_cart.php'><button type='submit'class='icono fa-solid fa-cart-shopping fa-2xl cursor-pointer hover:text-accent'></button></a></div>";
        }
          ?>
    </div>
  </nav>