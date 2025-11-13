<?php 

function showProducts($p) {
    echo "<li class='bg-background border border-callToAction shadow-md rounded-xl p-4 w-56 flex flex-col items-center text-center transition-transform hover:border-accent'>";

    echo "<img src='{$p['product_image']}' class='w-44 h-44 object-cover mb-3 rounded-lg'>";
    echo "<strong class='text-lg font-medium mb-1 text-texto'>{$p['product_name']}</strong>";
    echo "<p class='text-texto mb-3'>Precio: <span class='font-semibold'>{$p['product_price']} €</span></p>";

    echo "<div class='flex gap-2 flex-wrap justify-center'>";
    
    if (!empty($_SESSION)) {
        include $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/forms/products/form_product_update_call.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/forms/products/form_product_delete_call.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/forms/products/form_add_to_cart.php';
    }

    echo "</div>";
    echo "</li>";
}
?>
