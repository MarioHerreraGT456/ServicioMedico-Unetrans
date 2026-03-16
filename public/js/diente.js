document.addEventListener("DOMContentLoaded", function () {
    const botonesDientes = document.querySelectorAll(".btn-diente");
    const inputDiente = document.getElementById("input_diente");

    // Array para guardar los dientes seleccionados
    let dientesSeleccionados = [];

    // RECUPERAR DATOS (Útil si falla la validación en Laravel y la página recarga)
    if (inputDiente.value) {
        try {
            // Intentamos leer el JSON. Si viene de old('diente') de Laravel, ya es un string
            dientesSeleccionados = JSON.parse(inputDiente.value);

            // Le ponemos la clase a los botones que ya estaban seleccionados
            botonesDientes.forEach((btn) => {
                if (dientesSeleccionados.includes(btn.dataset.diente)) {
                    btn.classList.add("seleccionado");
                }
            });
        } catch (e) {
            console.error("Error al leer los dientes previos:", e);
        }
    }

    // LÓGICA DE SELECCIÓN MÚLTIPLE
    botonesDientes.forEach((boton) => {
        boton.addEventListener("click", function () {
            const numDiente = this.dataset.diente;
            const index = dientesSeleccionados.indexOf(numDiente);

            if (index > -1) {
                // Si el diente ya está en el array, lo quitamos (deseleccionar)
                dientesSeleccionados.splice(index, 1);
                this.classList.remove("seleccionado");
            } else {
                // Si no está en el array, lo agregamos (seleccionar)
                dientesSeleccionados.push(numDiente);
                this.classList.add("seleccionado");
            }

            // Convertimos el array a formato JSON y lo guardamos en el input oculto
            inputDiente.value = JSON.stringify(dientesSeleccionados);
        });
    });
});
