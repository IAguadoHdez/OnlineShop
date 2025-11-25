document.addEventListener("DOMContentLoaded", () => {
  const resultContainer = document.getElementById("productosContainer");
  const searchProductInput = document.getElementById("searchProduct");

  function callSearchProducts(strProduct) {
    /* Si mi strProduct esta vacio uso la url para poder ver todos los productos
     y si no esta vacio agrego "?q=" + el valor del input */
    const url =
      strProduct.trim() === ""
        ? "/student002/shop/backend/functions/getproducts.php"
        : "/student002/shop/backend/functions/getproducts.php?q=" + encodeURIComponent(strProduct);

    // Realizo la peticion HTTP a la url que le hemos indicado antes
    fetch(url)
      .then((response) => response.text()) // Convierto la respuesta que me de a texto
      .then((data) => (resultContainer.innerHTML = data)) // Inserto dentro del contenedor los datos que hemos recibido
  }

  searchProductInput.addEventListener("keyup", (e) => {
    callSearchProducts(e.target.value);
  });
});