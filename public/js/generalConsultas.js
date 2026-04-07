document.addEventListener("DOMContentLoaded", () => {
    const especialidad = document.getElementById("especialidad");
    const contenedor = document.getElementById("contenedor_tipo_consulta");
    const botonesAnt = document.querySelectorAll(".btn-ant1");
    const inputTipoConsulta = document.getElementById("tipo_consulta");

    function toggleTipoConsulta() {
        if (especialidad.value === "general") {
            contenedor.style.display = "block";
        } else {
            contenedor.style.display = "none";
        }
    }
    botonesAnt.forEach((boton) => {
        boton.addEventListener("click", function () {
            const valor = this.dataset.valor;

            // quitar selección anterior
            botonesAnt.forEach((b) => b.classList.remove("activo"));

            // marcar actual
            this.classList.add("activo");

            // asignar valor SIMPLE (no array)
            inputTipoConsulta.value = valor;

            console.log("Seleccionado:", valor);
        });
    });
    console.log(document.getElementById("tipo_consulta").value);

    // Ejecutar al cargar
    toggleTipoConsulta();

    // Ejecutar cuando cambie
    especialidad.addEventListener("change", toggleTipoConsulta);
});
