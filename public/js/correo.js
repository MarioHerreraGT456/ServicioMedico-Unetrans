document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("formCambiarClave");

    if (!form) return;

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        fetch(window.perfilUpdateClaveUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": window.csrfToken
            },
            body: JSON.stringify({})
        })
        .then(res => res.json())
        .then(data => {

            if (data.success) {

                Swal.fire({
                    icon: "success",
                    title: "Correo enviado",
                    text: data.message
                });

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
                text: "Ocurrió un problema al procesar la solicitud."
            });
        });

    });

});