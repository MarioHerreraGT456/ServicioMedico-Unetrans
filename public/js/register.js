document.addEventListener("DOMContentLoaded", function () {
    const categoriaSelect = document.getElementById("categoria");
    const containerPersonal = document.getElementById(
        "container_tipo_paciente",
    );
    const containerCarrera = document.getElementById("container_carrera");

    const selectPersonal = document.getElementById("tipo_paciente");
    const selectCarrera = document.getElementById("carrera");

    function actualizarFormulario() {
        // --- PASO 1: EL REINICIO ---
        // Ocultamos ambos contenedores por defecto
        containerPersonal.style.display = "none";
        containerCarrera.style.display = "none";

        // Deshabilitamos ambos selects para que no se envíen datos vacíos
        selectPersonal.disabled = true;
        selectCarrera.disabled = true;

        // Limpiamos los valores para que si el usuario vuelve a elegir la opción,
        // no aparezca lo que seleccionó anteriormente por error
        // (Opcional: puedes comentar estas dos líneas si prefieres mantener la selección previa)
        // selectPersonal.value = "";
        // selectCarrera.value = "";

        // --- PASO 2: LA LÓGICA DE ACTIVACIÓN ---
        const valor = categoriaSelect.value;

        if (valor === "estudiante") {
            containerCarrera.style.display = "block";
            selectCarrera.disabled = false;
        } else if (valor === "personal") {
            containerPersonal.style.display = "block";
            selectPersonal.disabled = false;
        }
    }

    // Escuchar el evento de cambio
    categoriaSelect.addEventListener("change", actualizarFormulario);

    // Ejecutar al cargar la página (por si hay un valor previo en el formulario)
    actualizarFormulario();
});
