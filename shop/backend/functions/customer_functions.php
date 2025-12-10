<?php

function showCustomer($c)
{
  echo "<li class='bg-[#eeeeee] border-2 border-textoSecundario/60 shadow-2xl hover:scale-101 rounded-xl p-4 w-56 flex flex-col items-center text-center transition-transform '>";

  echo "<strong class='text-lg font-medium mb-1 text-texto'>Nombre: {$c['customer_name']}, {$c['lastname']}</strong>";
  echo "<p class='text-texto mb-3'><span class='font-semibold'>Email: {$c['email']}</p>";
  echo "<strong class='text-lg font-medium mb-1 text-texto'>Teléfono: {$c['phone']}</strong>";
  echo "<div class='flex gap-2 flex-wrap justify-center'>";


  echo "<form action='/student002/shop/backend/forms/customer/form_customer_delete.php' method='POST'>
    <input type='hidden' name='customer_id' value='{$c['customer_id']}' required> 
    <button type='submit' class='fa-solid fa-trash icono'></button>
    </form>";

  echo "<form action='/student002/shop/backend/forms/customer/form_customer_update.php' method='POST'>
    <input type='hidden' name='customer_id' value='{$c['customer_id']}' required>
    <button type='submit' class='fa-solid fa-pen-to-square icono'></button>
    </form>";


  echo "</div>";
  echo "</li>";
}
