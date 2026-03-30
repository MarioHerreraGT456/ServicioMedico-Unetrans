document.addEventListener('DOMContentLoaded', function () {

    const forms = document.querySelectorAll('.form-estado');

    forms.forEach(form => {

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const button = form.querySelector('button');
            const esActivo = button.textContent.includes('Inactivar');

            Swal.fire({
                title: esActivo ? '¿Inactivar usuario?' : '¿Activar usuario?',
                text: esActivo 
                    ? 'El usuario no podrá iniciar sesión' 
                    : 'El usuario podrá iniciar sesión nuevamente',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: esActivo ? '#d33' : '#28a745',
                confirmButtonText: 'Confirmar'
            }).then((result) => {

                if (result.isConfirmed) {

                    const formData = new FormData(form);
                    formData.append('_method', 'PATCH');

                    fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {

                        Swal.fire({
                            title: '¡Listo!',
                            text: data.message,
                            icon: 'success'
                        });

                        // 🔥 CAMBIAR BOTÓN DINÁMICAMENTE
                        if (data.estado) {
                            button.textContent = 'Inactivar Usuario';
                            button.classList.remove('btn-activar');
                            button.classList.add('btn-inactivar');
                        } else {
                            button.textContent = 'Activar Usuario';
                            button.classList.remove('btn-inactivar');
                            button.classList.add('btn-activar');
                        }

                    });

                }

            });

        });

    });

});