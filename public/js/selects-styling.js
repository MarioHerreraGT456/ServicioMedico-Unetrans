/*******************************************************
 * SELECTS CON PLACEHOLDER GRIS / TEXTO NEGRO
 *******************************************************/
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("select").forEach((select) => {
        select.addEventListener("change", () => {
            if (select.value) {
                select.classList.add("active");
            } else {
                select.classList.remove("active");
            }
        });
    });
});
