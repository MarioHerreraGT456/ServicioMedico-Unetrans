// Puedes colocar este código en tu archivo js/app.js (ya incluido al final)
document.addEventListener("DOMContentLoaded", function () {
    const categoriaSelect = document.getElementById("categoria");
    const tipoPacienteDiv = document.querySelector(
        ".campo:has(#tipo_paciente)",
    ); // o usa un ID en el contenedor
    const tipoPacienteSelect = document.getElementById("tipo_paciente");

    function toggleTipoPaciente() {
        if (categoriaSelect.value === "personal") {
            tipoPacienteDiv.style.display = "block"; // o elimina clase 'hidden'
            tipoPacienteSelect.disabled = false;
        } else {
            tipoPacienteDiv.style.display = "none";
            tipoPacienteSelect.disabled = true; // Para que no se envíe su valor al servidor
            tipoPacienteSelect.value = ""; // Opcional: limpiar selección
        }
    }

    // Ejecutar al cargar por si había un valor antiguo (old)
    toggleTipoPaciente();

    // Escuchar cambios
    categoriaSelect.addEventListener("change", toggleTipoPaciente);
});
