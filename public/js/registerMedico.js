document.addEventListener("DOMContentLoaded", function () {
    const rolSelect = document.getElementById("rol");
    const containerPaciente = document.getElementById(
        "container_tipo_paciente",
    );

    // Obtenemos todos los inputs dentro del contenedor para poder desactivarlos
    const inputsPaciente = containerPaciente.querySelectorAll("input");

    function actualizarFormulario() {
        const valor = rolSelect.value;

        if (valor === "especial") {
            // Mostrar y habilitar campos
            // containerPaciente.style.display = "block";
            inputsPaciente.forEach((input) => {
                input.disabled = false;
            });
        } else {
            // Ocultar y deshabilitar campos (así no se envían al servidor)
            // containerPaciente.style.display = "none";
            inputsPaciente.forEach((input) => {
                input.disabled = true;
            });
        }
    }

    // Escuchar el cambio
    rolSelect.addEventListener("change", actualizarFormulario);

    // Ejecutar al inicio
    actualizarFormulario();
});
