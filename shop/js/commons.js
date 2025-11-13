document.addEventListener("DOMContentLoaded", () => {
  const btnMenu = document.querySelector(".nav-desplegable");
  const menuOverlay = document.querySelector(".menu-overlay");
  const btnClose = document.querySelector(".menu-close");
  const logo = document.querySelector('img[alt="logo"]');
  const logoTailwind = document.querySelector(".logo");

  if (btnMenu && menuOverlay && btnClose) {
    btnMenu.addEventListener("click", () =>
      menuOverlay.classList.add("activo")
    );
    btnClose.addEventListener("click", () =>
      menuOverlay.classList.remove("activo")
    );
  }

  if (logo) {
    logo.addEventListener(
      "click",
      () => (window.location.href = "/shop/index.html")
    );
  }

  if (logoTailwind) {
    logo.addEventListener(
      "click",
      () => (window.location.href = "/shop/index.html")
    );
  }
});
