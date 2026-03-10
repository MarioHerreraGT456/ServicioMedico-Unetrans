document.addEventListener("DOMContentLoaded", function () {
    const botonesDientes = document.querySelectorAll(".btn-diente");
    const inputDiente = document.getElementById("input_diente");

    botonesDientes.forEach((boton) => {
        boton.addEventListener("click", function () {
            // 1. Quitar la clase "seleccionado" de todos los dientes (para que solo se elija uno)
            botonesDientes.forEach((btn) =>
                btn.classList.remove("seleccionado"),
            );

            // 2. Añadir la clase al que le dimos clic (animación de color)
            this.classList.add("seleccionado");

            // 3. Pasar el número del diente al input oculto para enviarlo por POST
            inputDiente.value = this.getAttribute("data-diente");
        });
    });

    // Si la página recarga por un error de validación, mantener coloreado el diente anterior
    if (inputDiente.value) {
        const dienteAnterior = document.querySelector(
            `.btn-diente[data-diente="${inputDiente.value}"]`,
        );
        if (dienteAnterior) {
            dienteAnterior.classList.add("seleccionado");
        }
    }
});
