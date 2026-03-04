document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".btn-selector");
    const backButtons = document.querySelectorAll(".btn-regresar");
    const selectorModal = document.getElementById("selector-tipo-familiar");
    const allViews = document.querySelectorAll(".view");

    // Navegación (Entrar al form)
    buttons.forEach((btn) => {
        btn.addEventListener("click", function () {
            const targetId = this.getAttribute("data-target");
            const targetForm = document.getElementById(targetId);

            if (targetForm) {
                selectorModal.classList.add("hidden");
                targetForm.classList.remove("hidden");
                window.scrollTo({ top: 0, behavior: "smooth" });
            }
        });
    });

    // Navegación (Volver al selector)
    backButtons.forEach((btn) => {
        btn.addEventListener("click", function () {
            allViews.forEach((view) => view.classList.add("hidden"));
            selectorModal.classList.remove("hidden");
        });
    });

    const inputNumeroHijo = document.getElementById("numero_hijo");
    const inputCedulaNino = document.getElementById("cedula2_nino");

    // Verificamos que los inputs existan en el DOM
    if (inputNumeroHijo && inputCedulaNino) {
        // Extraemos los datos del padre guardados en los atributos "data-" del input
        const cedulaPadre = inputNumeroHijo.getAttribute("data-cedula-padre");
        const anioPadre = inputNumeroHijo.getAttribute("data-anio-padre");
        console.log("Cédula del padre:", cedulaPadre);
        console.log("Año del padre:", anioPadre);

        inputNumeroHijo.addEventListener("input", function () {
            const numHijo = this.value.trim();

            if (numHijo !== "") {
                // Genera la cédula en vivo
                const cedulaGenerada = `${numHijo}${anioPadre}${cedulaPadre}`;
                inputCedulaNino.setAttribute("value", cedulaGenerada);
                inputCedulaNino.value = cedulaGenerada;

                console.log("Cédula generada:", cedulaGenerada);
            } else {
                // Si borra el número, vaciamos la cédula
                inputCedulaNino.value = "";
            }
        });
    }
});
