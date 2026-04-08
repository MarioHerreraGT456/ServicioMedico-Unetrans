function initImportCSV() {

    let input = document.getElementById('input-csv');

    if (!input) return; // 🔥 evita errores

    // evitar duplicar eventos
    input.removeEventListener('change', handleCSVChange);
    input.addEventListener('change', handleCSVChange);
}

function handleCSVChange(e) {

    let file = e.target.files[0];
    if (!file) return;

    let reader = new FileReader();

    reader.onload = function (event) {

        let text = event.target.result;
        let rows = text.split("\n");

        let preview = [];
        let errores = [];

        rows.forEach((row, index) => {

            if (index === 0) return;

            let cols = row.split(",");

            if (!cols[0] || !cols[1] || !cols[3] || !cols[5]) {
                errores.push(`Fila ${index + 1} incompleta`);
                return;
            }

            if (cols[5] !== 'estudiante' && cols[5] !== 'personal') {
                errores.push(`Fila ${index + 1} tipo inválido`);
                return;
            }

            preview.push(cols);
        });

        if (errores.length > 0) {

            Swal.fire({
                icon: 'error',
                title: 'Error en archivo',
                html: `
                    Se encontraron ${errores.length} errores.<br><br>
                    ${errores.slice(0,5).join("<br>")}
                `
            });

            e.target.value = '';
            return;
        }

        let html = "<table style='width:100%; text-align:left;'>";

        preview.slice(0,5).forEach(row => {
            html += `<tr>
                <td>${row[0]}</td>
                <td>${row[1]}</td>
                <td>${row[3]}</td>
                <td>${row[5]}</td>
            </tr>`;
        });

        html += "</table>";

        Swal.fire({
            title: 'Vista previa',
            html: html,
            showCancelButton: true,
            confirmButtonText: 'Importar',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-import').submit();
            } else {
                e.target.value = '';
            }
        });
    };

    reader.readAsText(file);
}

// 🔥 funciones UI
function toggleImportMenu() {
    let menu = document.getElementById('submenu-import');
    if (menu) menu.classList.toggle('active');
}

function abrirImportCSV() {
    let input = document.getElementById('input-csv');
    if (input) input.click();
}

// 🔥 ejecutar al cargar
document.addEventListener("DOMContentLoaded", initImportCSV);