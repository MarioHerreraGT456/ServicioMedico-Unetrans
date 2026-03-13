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
    const inputFechaNacimiento = document.getElementById("fecha_nacimiento1"); // Lo llamamos desde el document

    // Verificamos que los inputs existan en el DOM
    if (inputNumeroHijo && inputCedulaNino && inputFechaNacimiento) {
        const cedulaPadre = inputNumeroHijo.getAttribute("data-cedula-padre");
        let dosDigitosAnio = ""; // Variable para guardar los 2 dígitos dinámicamente

        // 1. Escuchamos cuando el usuario seleccione la fecha de nacimiento
        inputFechaNacimiento.addEventListener("change", function () {
            const valorFecha = this.value; // Ej: "2015-08-20"

            if (valorFecha) {
                const anioCompleto = valorFecha.split("-")[0]; // "2015"
                dosDigitosAnio = anioCompleto.slice(-2); // "15"

                // Llamamos a la función por si el usuario llenó primero la fecha y luego el hijo
                generarCedula();
            }
        });

        // 2. Función encargada de armar la cédula
        function generarCedula() {
            const numHijo = inputNumeroHijo.value.trim();

            // Validamos que exista el número de hijo y que ya se haya seleccionado la fecha
            if (numHijo !== "" && dosDigitosAnio !== "") {
                const cedulaGenerada = `${numHijo}${cedulaPadre}${dosDigitosAnio}`;
                inputCedulaNino.setAttribute("value", cedulaGenerada);
                inputCedulaNino.value = cedulaGenerada;
            } else {
                inputCedulaNino.value = ""; // Vaciamos si falta algún dato
            }
        }

        // 3. Escuchamos cuando el usuario escriba el número de hijo
        inputNumeroHijo.addEventListener("input", generarCedula);
    }
});
