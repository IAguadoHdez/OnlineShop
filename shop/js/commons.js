document.addEventListener("DOMContentLoaded", () => {
  const btnMenu = document.querySelector(".nav-desplegable");
  const menuOverlay = document.querySelector(".menu-overlay");
  const btnClose = document.querySelector(".menu-close");
  const logo = document.querySelector('img[alt="logo"]');
  const logoTailwind = document.querySelector(".logo");
  const carritoCompra = document.querySelector("#cart");

  // Función para obtener la ruta base
  const basePath = () => {
    const pathParts = window.location.pathname.split("/");
    // Si estamos dentro de 'views', subimos un nivel
    if (pathParts.includes("views")) return "../";
    return "./";
  };

  // Menú desplegable
  if (btnMenu && menuOverlay && btnClose) {
    btnMenu.addEventListener("click", () =>
      menuOverlay.classList.add("activo")
    );
    btnClose.addEventListener("click", () =>
      menuOverlay.classList.remove("activo")
    );
  }

  // Logo index.html o Tailwind
  if (logo) {
    logo.addEventListener("click", () => {
      window.location.href = `${basePath()}index.html`;
    });
  }

  if (logoTailwind) {
    logoTailwind.addEventListener("click", () => {
      window.location.href = `${basePath()}index.html`;
    });
  }

  // Carrito de compras
  if (carritoCompra) {
    carritoCompra.addEventListener("click", () => {
      window.location.href = `${basePath()}views/shoppingCart.html`;
    });
  }
});
