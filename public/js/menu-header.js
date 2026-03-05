document.addEventListener("DOMContentLoaded", () => {
    // Selecciona el sidebar de la vista actual (aplica para guest, medico y paciente)
    const sidebar = document.querySelector(".sidebar");

    // Selecciona los botones de abrir (el original y el nuevo exclusivo de móvil)
    const menuBtns = document.querySelectorAll(
        ".main-header__icon-menu, .js-menu-trigger",
    );

    if (sidebar) {
        const closeBtn = sidebar.querySelector(".close");

        // Al hacer click en cualquier botón de menú, abrir el sidebar
        menuBtns.forEach((btn) => {
            btn.addEventListener("click", () => {
                sidebar.style.display = "flex";
            });
        });

        // Al hacer click en la X, cerrar
        if (closeBtn) {
            closeBtn.addEventListener("click", () => {
                sidebar.style.display = "none";
            });
        }

        // Si se hace click fuera del contenido (en el modal de fondo), cerrar
        window.onclick = function (event) {
            if (event.target == sidebar) {
                sidebar.style.display = "none";
            }
        };
    }
});
