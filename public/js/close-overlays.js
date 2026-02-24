/*******************************************************
 * CERRAR OVERLAYS (LOGIN, REGISTRO, RECUPERAR, ETC.)
 *******************************************************/
document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("btnCerrarLogin")?.addEventListener("click", () => {
        document.getElementById("loginOverlay")?.classList.add("oai-hidden");
    });

    document
        .getElementById("btnCerrarRegistro")
        ?.addEventListener("click", () => {
            document
                .getElementById("registroOverlay")
                ?.classList.add("oai-hidden");
        });

    document
        .getElementById("btnCerrarRecuperar")
        ?.addEventListener("click", () => {
            document
                .getElementById("recuperarOverlay")
                ?.classList.add("oai-hidden");
        });

    document
        .getElementById("btnCerrarCodRecuperacion")
        ?.addEventListener("click", () => {
            document
                .getElementById("codigoOverlay")
                ?.classList.add("oai-hidden");
        });

    document
        .getElementById("btnCerrarNuevaClave")
        ?.addEventListener("click", () => {
            document
                .getElementById("nuevaClaveOverlay")
                ?.classList.add("oai-hidden");
        });
});
