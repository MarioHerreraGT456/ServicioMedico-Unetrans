document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("formRegistroMedico");

    if (!form) return;

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        const formData = new FormData(form);

        // ALERT DE CARGA
        Swal.fire({
            title: "Creando cuenta",
            html: `
                <div class="loader-container">
                    <div class="loader"></div>
                    <p>Enviando enlace para crear tu contraseña...</p>
                </div>
            `,
            showConfirmButton: false,
            allowOutsideClick: false
        });

        fetch(window.envioCorreoUrl, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": window.csrfToken
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {

            Swal.close();

            if (data.success) {

                Swal.fire({
                    icon: "success",
                    title: "Correo enviado",
                    text: data.message,
                    confirmButtonText: "OK"
                });

                form.reset();

            } else {

                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: data.message
                });

            }

        })
        .catch(error => {

            console.error(error);

            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Ocurrió un problema al procesar el registro."
            });

        });

    });

});