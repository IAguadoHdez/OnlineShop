<?php include('header.php'); ?>



<div class="flex">
  <aside class="w-48 p-4 border-r border-[#737373]">
    
    <!-- Products -->
    <div class="mb-4">
      <div class="mb-2 font-semibold text-[#00C4CC] cursor-pointer flex justify-between items-center"
           onclick="toggleMenu('products-menu', this)">
        Products <span>▼</span>
      </div>
      <ul id="products-menu" class="ml-4 hidden">
        <a href="forms/products/form_product_select.php"><li class="mb-1 hover:text-[#00C4CC] cursor-pointer">Select</li></a>
        <a href="forms/products/form_product_insert.php"><li class="mb-1 hover:text-[#00C4CC] cursor-pointer">Insert</li></a>
        <a href="forms/products/form_product_update_call.php"><li class="mb-1 hover:text-[#00C4CC] cursor-pointer">Update</li></a>
        <a href="forms/products/form_product_delete_call.php"><li class="mb-1 hover:text-[#00C4CC] cursor-pointer">Delete</li></a>
      </ul>
    </div>

    <!-- Customers -->
    <div class="mb-4">
      <div class="mb-2 font-semibold text-[#00C4CC] cursor-pointer flex justify-between items-center" onclick="toggleMenu('customers-menu', this)"> Customers<span>▼</span></div>
      <ul id="customers-menu" class="ml-4 hidden">
        <li class="mb-1 hover:text-[#00C4CC] cursor-pointer">Search</li>
        <a href="forms/customers/form_customer_insert.php"><li class="mb-1 hover:text-[#00C4CC] cursor-pointer">Insert</li></a>
        <a href="forms/customers/form_customer_update_call.php"><li class="mb-1 hover:text-[#00C4CC] cursor-pointer">Update</li></a>
        <a href="forms/customers/form_customer_delete_call.php"><li class="mb-1 hover:text-[#00C4CC] cursor-pointer">Delete</li></a>

      </ul>
    </div>

    <!-- Orders -->
    <div class="mb-4">
      <div class="mb-2 font-semibold text-[#00C4CC] cursor-pointer flex justify-between items-center"
           onclick="toggleMenu('orders-menu', this)">
        Orders <span>▼</span>
      </div>
      <ul id="orders-menu" class="ml-4 hidden">
        <li class="mb-1 hover:text-[#00C4CC] cursor-pointer">Search</li>
        <li class="mb-1 hover:text-[#00C4CC] cursor-pointer">Insert</li>
        <li class="mb-1 hover:text-[#00C4CC] cursor-pointer">Update</li>
        <li class="mb-1 hover:text-[#00C4CC] cursor-pointer">Delete</li>
      </ul>
    </div>

  </aside>

  <main class="flex-1 p-4">
    <h1 class="text-2xl font-bold mb-4">Panel de Administración</h1>
  </main>
</div>

<script src="index.js"></script>

<?php include('footer.php'); ?>


<?php include('footer.php'); ?>
