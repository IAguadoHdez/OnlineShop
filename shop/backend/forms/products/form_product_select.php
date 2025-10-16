<?php 
    include  __DIR__ . '/../../config/db_connection.php';
    include  __DIR__ . '/../../header.php';

    $sql = 'SELECT * 
            FROM products';


    
    $result = mysqli_query($connection,$sql); 

    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

    foreach ($products as $product) {
        // print_r($product);
        echo "<p class='p-2'>" .'ID'.' | '. 'Nombre Producto'.' | '.'Precio'.' | '.'Stock'.' | '.'Categoria'. "</p>";
        echo '<p class="p-2">' .$product['product_id'].' | '.$product['product_name'].' | '.$product['product_price'].' | '.$product['stock'].' | '.$product['category_id']. '</p>';

        echo '<hr class="mb-2">';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="../../index.php" class="block mt-6 text-sm text-[#737373] hover:text-[#00C4CC] transition ml-5 f">← Volver al inicio</a>
</body>
</html>