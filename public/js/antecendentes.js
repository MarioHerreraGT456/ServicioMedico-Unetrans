document.addEventListener("DOMContentLoaded", function () {
    const botonesAnt = document.querySelectorAll(".btn-ant");
    const inputAnt = document.getElementById("input_antecedentes");

    let seleccionados = [];

    // Cargar datos previos si existen (ej. por errores de validación)
    if (inputAnt.value) {
        try {
            seleccionados = JSON.parse(inputAnt.value);
            botonesAnt.forEach((btn) => {
                if (seleccionados.includes(btn.dataset.valor)) {
                    btn.classList.add("activo");
                }
            });
        } catch (e) {
            console.log("Error al cargar antecedentes previos");
        }
    }

    botonesAnt.forEach((boton) => {
        boton.addEventListener("click", function () {
            const valor = this.dataset.valor;
            const index = seleccionados.indexOf(valor);

            if (index > -1) {
                // Quitar de la lista
                seleccionados.splice(index, 1);
                this.classList.remove("activo");
            } else {
                // Agregar a la lista
                seleccionados.push(valor);
                this.classList.add("activo");
            }

            // Actualizar el input oculto con el JSON
            inputAnt.value = JSON.stringify(seleccionados);
        });
    });
});
