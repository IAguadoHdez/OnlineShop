document.addEventListener('DOMContentLoaded', () => {
    const btnMenu = document.querySelector('.nav-desplegable i');
    const menuOverlay = document.querySelector('.menu-overlay');
    const btnClose = document.querySelector('.menu-close i');

    if (btnMenu && menuOverlay && btnClose) {
        // Abrir menú
        btnMenu.addEventListener('click', () => {
            menuOverlay.classList.add('activo');
        });

        // Cerrar menú solo con la X
        btnClose.addEventListener('click', () => {
            menuOverlay.classList.remove('activo');
        });
    }
});
