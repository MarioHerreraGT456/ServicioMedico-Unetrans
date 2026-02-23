document.addEventListener("DOMContentLoaded", () => {
    const menuBtn = document.querySelector(".main-header__icon-menu");
    const sidebar = document.querySelector(".sidebar");
    console.log(menuBtn, sidebar);
    menuBtn.addEventListener("click", () => {
        sidebar.style.display = "flex";
    });
});
