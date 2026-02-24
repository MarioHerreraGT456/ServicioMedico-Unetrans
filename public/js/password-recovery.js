/*******************************************************
 * RECUPERACIÓN DE CONTRASEÑA (CORREO Y CÓDIGO)
 *******************************************************/
document.addEventListener("DOMContentLoaded", () => {
    const formEmail = document.getElementById("formRecuperarEmail");
    const formCodigo = document.getElementById("formRecuperarCodigo");
    const paso1 = document.getElementById("recuperarPaso1");
    const paso2 = document.getElementById("recuperarPaso2");
    const contadorEl = document.getElementById("contadorTiempo");
    const btnReenviar = document.getElementById("btnReenviar");

    let tiempo = 120;
    let intervalo = null;

    function iniciarContador() {
        tiempo = 120;
        if (contadorEl) contadorEl.textContent = tiempo;
        if (btnReenviar) btnReenviar.disabled = true;

        intervalo = setInterval(() => {
            tiempo--;
            if (contadorEl) contadorEl.textContent = tiempo;

            if (tiempo <= 0) {
                clearInterval(intervalo);
                if (btnReenviar) btnReenviar.disabled = false;
                if (contadorEl) contadorEl.textContent = 0;
            }
        }, 1000);
    }

    formEmail?.addEventListener("submit", (e) => {
        e.preventDefault();
        // Simular envío de correo
        if (paso1) paso1.classList.add("oai-hidden");
        if (paso2) paso2.classList.remove("oai-hidden");
        iniciarContador();
    });

    btnReenviar?.addEventListener("click", () => {
        iniciarContador();
        console.log("Reenviar código...");
    });
});
