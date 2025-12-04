document.addEventListener("DOMContentLoaded", () => {
  const resultContainer = document.getElementById("productosContainer");
  const searchProductInput = document.getElementById("searchProduct");

  async function callSearchProducts(query = "") {
    const url = "/student002/shop/backend/endpoints/getproducts.php?q=" + encodeURIComponent(query);

    try {
      const response = await fetch(url);
      const productos = await response.json();
      resultContainer.innerHTML = "";

      if (productos.length === 0) {
        resultContainer.innerHTML = "<p>No se encontraron productos.</p>";
        return;
      }

      productos.forEach(p => {
        const li = document.createElement("li");
        li.className = "bg-[#eeeeee] border-2 border-textoSecundario/60 shadow-2xl hover:scale-101 rounded-xl p-4 w-56 flex flex-col items-center text-center transition-transform";

        li.innerHTML = `
          <img src="${p.product_image}" class="w-44 h-44 object-cover mb-3 rounded-lg">
          <strong class="text-lg font-medium mb-1 text-texto">${p.product_name}</strong>
          <p class="text-texto mb-3">Precio: <span class="font-semibold">${p.product_price} €</span></p>
          <div class="flex gap-2 flex-wrap justify-center">
            <form action="/student002/shop/backend/forms/products/form_product_delete.php" method="POST">
              <input type="hidden" name="product_id" value="${p.product_id}" required> 
              <button type="submit" class="fa-solid fa-trash icono"></button>
            </form>

            <form action="/student002/shop/backend/forms/products/form_product_update.php" method="POST">
              <input type="hidden" name="product_id" value="${p.product_id}" required>
              <button type="submit" class="fa-solid fa-pen-to-square icono"></button>
            </form>

            <form action="/student002/shop/backend/public/shopping_cart.php" method="POST">
              <input type="hidden" name="sum_product_id" value="${p.product_id}">
              <button type="submit" class="fa-solid fa-cart-plus icono"></button>
            </form>
          </div>
        `;

        resultContainer.appendChild(li);
      });

    } catch (error) {
      console.error("Error al cargar productos:", error);
      resultContainer.innerHTML = "<p>Error al cargar productos</p>";
    }
  }

  // Escucha input para búsqueda
  searchProductInput.addEventListener("keyup", (e) => {
    callSearchProducts(e.target.value);
  });

  // Cargar todos los productos al inicio
  callSearchProducts("");
});
