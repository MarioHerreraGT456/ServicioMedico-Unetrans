document.addEventListener("DOMContentLoaded", () => {

    const formEmail = document.getElementById("formRecuperarEmail");
    const contadorTexto = document.getElementById("reenvioCountdown");
    const contadorBoton = document.getElementById("reenvioCountdownBtn");
    const btnReenviar = document.getElementById("btnReenviar");

    let tiempoInicial = 120;
    let tiempoRestante = tiempoInicial;
    let intervalo = null;

    function actualizarContadores() {

        if (contadorTexto) {
            contadorTexto.textContent = tiempoRestante;
        }

        if (contadorBoton) {
            contadorBoton.textContent = tiempoRestante;
        }

    }

    function detenerContador() {

        if (intervalo) {
            clearInterval(intervalo);
            intervalo = null;
        }

    }

    function iniciarContador() {

        detenerContador();

        tiempoRestante = tiempoInicial;

        actualizarContadores();

        if (btnReenviar) {
            btnReenviar.disabled = true;
        }

        intervalo = setInterval(() => {

            tiempoRestante--;

            actualizarContadores();

            if (tiempoRestante <= 0) {

                detenerContador();

                tiempoRestante = 0;

                actualizarContadores();

                if (btnReenviar) {
                    btnReenviar.disabled = false;
                }

            }

        }, 1000);

    }

    if (formEmail) {

        formEmail.addEventListener("submit", async (e) => {

            e.preventDefault();

            const email = document.getElementById("recEmail").value;

            if (!email) {

                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Debes ingresar un correo electrónico"
                });

                return;
            }

            try {

                const formData = new FormData();
                formData.append("email", email);

                const response = await fetch(formEmail.action, {

                    method: "POST",

                    headers: {
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .content
                    },

                    body: formData

                });

                const data = await response.json();

                if (data.success) {

                    Swal.fire({
                        icon: "success",
                        title: "Correo enviado",
                        text: data.message
                    });

                    iniciarContador();

                } else {

                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: data.message
                    });

                }

            } catch (error) {

                console.error(error);

                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "No se pudo enviar el correo."
                });

            }

        });

    }

    if (btnReenviar) {

        btnReenviar.addEventListener("click", () => {

            if (btnReenviar.disabled) return;

            formEmail.dispatchEvent(new Event("submit"));

        });

    }

    actualizarContadores();

});