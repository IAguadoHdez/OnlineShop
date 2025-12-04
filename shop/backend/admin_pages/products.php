<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/header.php'; ?>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/functions/product_functions.php'; ?>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/db/products/db_getproducts.php'; ?>

<main class="px-4 md:px-8 lg:px-16 py-8 bg-background/90">
    <h1 class="text-3xl font-semibold text-center text-texto mb-8">Productos</h1>
    
    <div class='flex my-5 mx-10 w-full relative'>
        <div>
            <form action="" class="flex gap-2">
                <input id="searchProduct" type="text" name="product_name" class="inputs" placeholder="Buscar productos..."/>
            </form>
        </div>
        <div class="absolute right-15">
            <?php include($_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/forms/products/form_product_insert_call.php'); ?>
        </div>
    </div>

    <ul id="productosContainer" class="flex flex-wrap gap-8 justify-center">
        <?php foreach ($productos as $p) showProducts($p); ?>
    </ul>
</main>

<script src="/student002/shop/js/backend_products.js"></script>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/footer.php'; ?>
