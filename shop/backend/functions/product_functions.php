<?php

function showProducts($p)
{
    echo "<li class='bg-[#eeeeee] border-2 border-textoSecundario/60 shadow-2xl hover:scale-101 rounded-xl p-4 w-56 flex flex-col items-center text-center transition-transform '>";

    echo "<img src='{$p['product_image']}' class='w-44 h-44 object-cover mb-3 rounded-lg'>";
    echo "<strong class='text-lg font-medium mb-1 text-texto'>{$p['product_name']}</strong>";
    echo "<p class='text-texto mb-3'>Precio: <span class='font-semibold'>{$p['product_price']} €</span></p>";

    echo "<div class='flex gap-2 flex-wrap justify-center'>";

    
    echo "<form action='/student002/shop/backend/forms/products/form_product_delete.php' method='POST'>
    <input type='hidden' name='product_id' value='{$p['product_id']}' required> 
    <button type='submit' class='fa-solid fa-trash icono'></button>
    </form>";

    echo "<form action='/student002/shop/backend/forms/products/form_product_update.php' method='POST'>
    <input type='hidden' name='product_id' value='{$p['product_id']}' required>
    <button type='submit' class='fa-solid fa-pen-to-square icono'></button>
    </form>";

    echo "<form action='/student002/shop/backend/public/shopping_cart.php' method='POST'>
    <input type='hidden' name='sum_product_id' value='{$p['product_id']}'>
    <button type='submit' class='fa-solid fa-cart-plus icono'></i></button>
    </form>";


    echo "</div>";
    echo "</li>";
}
