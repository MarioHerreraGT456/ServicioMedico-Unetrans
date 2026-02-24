document.addEventListener("DOMContentLoaded", () => {
    const menuBtn = document.querySelector(".main-header__icon-menu");
    const sidebar = document.querySelector(".sidebar");
    const closeBtn = sidebar.querySelector(".close");

    console.log(menuBtn, sidebar);

    menuBtn.addEventListener("click", () => {
        sidebar.style.display = "flex";
    });

    closeBtn.addEventListener("click", () => {
        sidebar.style.display = "none";
    });

    window.onclick = function (event) {
        // Si el usuario hace clic exactamente en el fondo (el modal), no en el contenido
        if (event.target == sidebar) {
            sidebar.style.display = "none";
        }
    };
});
