/*******************************************************
 * REGISTRO DE PACIENTE (comentado, listo para activar)
 *******************************************************/
/*
document.addEventListener("DOMContentLoaded", () => {
    const registroOverlay = document.getElementById("registroOverlay");
    const formPaciente = document.querySelector("#formRegistroPaciente");

    if (!registroOverlay || !formPaciente) return;

    const tipoPaciente = document.getElementById("tipoPaciente");
    const selectCarrera = document.getElementById("selectCarrera");
    const selectPersonal = document.getElementById("selectPersonal");

    formPaciente.noValidate = true;

    function resetSelects() {
        if (selectCarrera) {
            selectCarrera.classList.add("hidden");
            selectCarrera.required = false;
            selectCarrera.value = "";
            selectCarrera.classList.remove("active");
        }
        if (selectPersonal) {
            selectPersonal.classList.add("hidden");
            selectPersonal.required = false;
            selectPersonal.value = "";
            selectPersonal.classList.remove("active");
        }
    }

    resetSelects();

    tipoPaciente?.addEventListener("change", () => {
        resetSelects();
        const value = tipoPaciente.value;
        if (value === "estudiante" && selectCarrera) {
            selectCarrera.classList.remove("hidden");
            selectCarrera.required = true;
        }
        if (value === "personal" && selectPersonal) {
            selectPersonal.classList.remove("hidden");
            selectPersonal.required = true;
        }
    });

    formPaciente.addEventListener("submit", async (e) => {
        e.preventDefault();
        e.stopPropagation();

        const tipo = (tipoPaciente?.value || "").trim();
        if (!tipo) {
            alert("Seleccione el tipo de paciente");
            return;
        }
        if (tipo === "estudiante" && selectCarrera && !selectCarrera.value) {
            alert("Seleccione la carrera");
            return;
        }
        if (tipo === "personal" && selectPersonal && !selectPersonal.value) {
            alert("Seleccione el tipo de personal");
            return;
        }

        const formData = new FormData(formPaciente);

        try {
            const res = await fetch("backend/controllers/registrarPaciente.php", {
                method: "POST",
                body: formData
            });
            const text = await res.text();
            let data;
            try {
                data = JSON.parse(text);
            } catch {
                console.error("Respuesta NO JSON en registrarPaciente.php:", text);
                alert("Error: el servidor no devolvió JSON válido.");
                return;
            }

            if (!data.success) {
                mostrarMensajeRegistroPaciente(data.message || "Error al registrar", "error");
                return;
            }

            // Éxito
            cedulaRegistroPaciente = formPaciente.querySelector('[name="cedula"]').value;
            mostrarMensajeRegistroPaciente("Registro exitoso. Ahora establezca su contraseña.", "success");

            setTimeout(() => {
                registroOverlay.classList.add("oai-hidden");
                document.getElementById("nuevaClaveOverlay")?.classList.remove("oai-hidden");
            }, 1200);
        } catch (err) {
            console.error(err);
            alert("Error de conexión");
        }
    });
});
*/

// Función para mostrar mensajes en el registro
function mostrarMensajeRegistroPaciente(texto, tipo) {
    let msg = document.getElementById("registroPacienteMsg");
    if (!msg) return;
    msg.textContent = texto;
    msg.classList.remove("oai-hidden", "error", "success");
    msg.classList.add(tipo);
}
