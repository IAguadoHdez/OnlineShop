document.addEventListener("DOMContentLoaded", () => {
  const destacadosContainer = document.getElementById("productosDestacadosContainer");
  const normalesContainer = document.getElementById("productosNormalesContainer");

  async function callSearchProducts(strProduct = "") {
    const url = "/student002/shop/backend/functions/getProductsFront.php?q=" + encodeURIComponent(strProduct);

    try {
      const response = await fetch(url);
      const productos = await response.json();

      destacadosContainer.innerHTML = "";
      normalesContainer.innerHTML = "";

      productos.forEach((p, index) => {
        const card = document.createElement("div");
        card.className = "product-card";

        card.innerHTML = `
          <div class="product-image">
            <a href="./views/productDetail.html"><img src="${p.product_image}" alt="${p.product_name}"></a>
          </div>
          <div class="product-info">
            <h3 class="product-title">${p.product_name}</h3>
            <div class="product-footer">
              <span class="product-price">€${p.product_price}</span>
              <i class="fa-solid fa-cart-plus fa-xl"></i>
            </div>
          </div>
        `;

        if (index < 5) destacadosContainer.appendChild(card);
        else normalesContainer.appendChild(card);
      });

      if (productos.length === 0) {
        normalesContainer.innerHTML = "<p>No se encontraron productos.</p>";
      }

    } catch (error) {
      console.error("Error al cargar los productos:", error);
    }
  }

  callSearchProducts();
});
