function atenderConsulta(id) {

    let card = document.getElementById('consulta-' + id);

    fetch(`${window.baseUrl}/consultas/${id}/atender`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {

        if (data.success) {

            // animación
            if (card) card.classList.add("removing");

            setTimeout(() => {

                // eliminar card
                if (card) card.remove();

                // ACTUALIZAR CONTADOR (AQUÍ VA)
                let contador = document.getElementById('contador-espera');

                if (contador) {
                    let valorActual = Number(contador.innerText.trim());

                    if (!isNaN(valorActual)) {
                        let nuevoValor = Math.max(valorActual - 1, 0);
                        contador.innerText = nuevoValor;
                    }
                }

            }, 400);

        }

    })
    .catch(error => {
        console.error(error);
    });
}