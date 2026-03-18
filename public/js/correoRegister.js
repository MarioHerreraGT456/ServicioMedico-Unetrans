document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formRegistroPaciente");

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
            allowOutsideClick: false,
        });

        fetch(window.envioCorreoUrl, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": window.csrfToken,
                Accept: "application/json", // ¡Importante para recibir los errores de validación!
            },
            body: formData,
        })
            .then(async (res) => {
                const data = await res.json();

                // Si Laravel detecta que la cédula (u otro dato) es inválido, devuelve un estado 422
                if (!res.ok) {
                    if (res.status === 422 && data.errors) {
                        // Extraemos el primer mensaje de error de la lista (ej. el de la cédula)
                        const primerError = Object.values(data.errors)[0][0];
                        throw new Error(primerError);
                    }
                    // Si es otro tipo de error (ej. error 500)
                    throw new Error(
                        data.message || "Ocurrió un error inesperado.",
                    );
                }

                return data;
            })
            .then((data) => {
                Swal.close();

                if (data.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Correo enviado",
                        text: data.message,
                        confirmButtonText: "OK",
                    });
                    form.reset();
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: data.message,
                    });
                }
            })
            .catch((error) => {
                Swal.close();
                console.error(error);

                // Aquí mostramos el mensaje exacto que configuraste en ExisteEnUniversidad.php
                Swal.fire({
                    icon: "error",
                    title: "Atención",
                    text: error.message,
                });
            });
    });
});
