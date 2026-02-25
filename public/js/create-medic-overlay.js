/*******************************************************
 * OVERLAY CREAR MÉDICO (JEFE MÉDICO)
 *******************************************************/
document.addEventListener("DOMContentLoaded", () => {
    const btnAbrir = document.getElementById("btnAbrirCrearMedico");
    const overlay = document.getElementById("crearMedicoOverlay");
    const btnCerrar = document.getElementById("btnCerrarCrearMedico");
    const btnCancelar = document.getElementById("btnCancelarCrearMedico");
    const form = document.querySelector("#formCrearMedico");
    const msg = document.querySelector("#crearMedicoMsg");

    if (!btnAbrir || !overlay) return;

    // Abrir
    btnAbrir.addEventListener("click", (e) => {
        e.preventDefault();
        overlay.classList.remove("oai-hidden");
    });

    // Cerrar funciones
    function cerrar() {
        overlay.classList.add("oai-hidden");
    }

    btnCerrar?.addEventListener("click", (e) => {
        e.preventDefault();
        cerrar();
    });

    btnCancelar?.addEventListener("click", (e) => {
        e.preventDefault();
        cerrar();
    });

    // Envío del formulario
    if (form) {
        form.addEventListener("submit", async (e) => {
            e.preventDefault();

            if (msg) {
                msg.classList.add("oai-hidden");
                msg.classList.remove("error", "success");
            }

            const formData = new FormData(form);

            try {
                const response = await fetch(
                    "backend/controllers/registrarMedico.php",
                    {
                        method: "POST",
                        body: formData,
                    },
                );
                const data = await response.json();

                if (!data.ok) {
                    if (msg) {
                        msg.textContent =
                            data.mensaje || "Error al registrar médico";
                        msg.classList.add("error");
                        msg.classList.remove("oai-hidden");
                    }
                    return;
                }

                // Éxito
                if (msg) {
                    msg.textContent = "Especialista registrado correctamente";
                    msg.classList.add("success");
                    msg.classList.remove("oai-hidden");
                }
                form.reset();

                setTimeout(() => {
                    overlay.classList.add("oai-hidden");
                    if (msg) msg.classList.add("oai-hidden");
                }, 1500);
            } catch (err) {
                if (msg) {
                    msg.textContent = "Error de conexión con el servidor";
                    msg.classList.add("error");
                    msg.classList.remove("oai-hidden");
                }
                console.error(err);
            }
        });
    }
});
