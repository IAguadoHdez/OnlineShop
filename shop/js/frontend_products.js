document.addEventListener("DOMContentLoaded", () => {
  const destacadosContainer = document.getElementById("productosDestacadosContainer");
  const normalesContainer = document.getElementById("productosNormalesContainer");

  function callSearchProducts(strProduct = "") {
    const url =
      strProduct.trim() === ""
        ? "/student002/shop/backend/functions/getProductsFront.php"
        : "/student002/shop/backend/functions/getProductsFront.php?q=" + encodeURIComponent(strProduct);

    fetch(url)
      .then(res => res.text())
      .then(data => {
        const wrapper = document.createElement("div");
        wrapper.innerHTML = data;
        const products = Array.from(wrapper.children);

        destacadosContainer.innerHTML = "";
        normalesContainer.innerHTML = "";

        products.forEach((product, index) => {
          if (index < 5) destacadosContainer.appendChild(product);
          else normalesContainer.appendChild(product);
        });
      });
  }

  callSearchProducts();
});
