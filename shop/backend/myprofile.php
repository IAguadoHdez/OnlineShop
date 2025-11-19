<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/header.php' ?>


<main class="flex flex-col items-center justify-center p-4">
  <h2 class="font-bold text-2xl p-2">My profile</h2>
  <div class="p-10">
    <img src="../assets/images/persona/persona.jpg" class="w-20 h-20 rounded-full object-cover border-b border-accent">
  </div>

  <div class=" flex flex-col gap-4 ">
    <form class="flex flex-col gap-4">
      <div class="nomUsuario">
        <label for="nUsuario">Name</label>
        <input type="text" class="inputs">
      </div>
      <div class="apellidoUsuario">
        <label for="lnUsuario">Last Name</label>
        <input type="text" class="inputs">
      </div>
      <div class="emailUsuario">
        <label for="emailUsuario">Email</label>
        <input type="email" class="inputs">
      </div>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/forms/customers/form_update_password_call.php' ?>
      <div class="phone">
        <label for="telUsuario">Tel</label>
        <input type="tel" class="inputs">
      </div>
      <button type="submit" class="buttons">Save changes</button>
    </form>
    <hr>
    <div class="flex flex-col gap-3">
      <h3 class="text-xl font-bold ">Shipping Address</h3>
      <button class="buttons w-[150px]">
        <i class="fa-solid fa-plus"></i>
        Add Address
      </button>
    </div>
    <hr>
    <div class="flex flex-col gap-3">
      <h3 class="text-xl font-bold">Payment Methods</h3>
      <button class="buttons w-[150px]">
        <i class="fa-solid fa-plus"></i>
        Add method
      </button>
    </div>

  </div>
</main>