// cerrarSesion.js

document.addEventListener('DOMContentLoaded', function () {

    const logoutButtons = document.querySelectorAll('.btn-logout');

    logoutButtons.forEach(button => {
        button.addEventListener('click', function () {

            const form = this.closest('form');

            Swal.fire({
                title: '¿Desea cerrar sesión?',
                text: 'Tu sesión se cerrará',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1c3d6d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, cerrar sesión',
                cancelButtonText: 'Cancelar'
            }).then((result) => {

                if (result.isConfirmed) {
                    form.submit();
                }

            });

        });
    });

});