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

                            // 🔥 ACTUALIZAR BOTÓN + ICONO
                            if (data.estado) {
                                button.innerHTML = `
                                    <span class="material-symbols-outlined">power_settings_new</span>
                                    Inactivar Usuario
                                `;
                                button.classList.remove('btn-activar');
                                button.classList.add('btn-inactivar');
                            } else {
                                button.innerHTML = `
                                    <span class="material-symbols-outlined">check_circle</span>
                                    Activar Usuario
                                `;
                                button.classList.remove('btn-inactivar');
                                button.classList.add('btn-activar');
                            }

                            // ACTUALIZAR TEXTO DE ESTADO EN LA CARD
                            const estadoSpan = form.closest('.perfil-container-card')
                                                .querySelector('.estado-text');

                            if (estadoSpan) {
                                if (data.estado) {
                                    estadoSpan.textContent = 'Activo';
                                    estadoSpan.classList.remove('status-inactive');
                                    estadoSpan.classList.add('status-active');
                                } else {
                                    estadoSpan.textContent = 'Inactivo';
                                    estadoSpan.classList.remove('status-active');
                                    estadoSpan.classList.add('status-inactive');
                                }
                            }

                        });

                }

            });

        });

    });

});