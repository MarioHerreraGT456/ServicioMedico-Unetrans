@extends('layouts.app')

@section('content')
<main class="main-content">
    <!-- Overlay de carga para PDF -->
<div id="pdf-loading-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: white; z-index: 9999; flex-direction: column; align-items: center; justify-content: center; font-family: Arial, sans-serif;">
    <div style="font-size: 24px; margin-bottom: 20px;">Generando PDF...</div>
    <div class="loader" style="border: 5px solid #f3f3f3; border-top: 5px solid #1f3c88; border-radius: 50%; width: 50px; height: 50px; animation: spin 1s linear infinite;"></div>
</div>

<style>
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
    <div class="container-welcome">
        <h1>Historial de Consultas</h1>
    </div>

    {{-- MOSTRAR BUSCADOR SOLO A MÉDICOS --}}
    @if ($persona->rol === 'medico')
        <div class="container-search">
            <span class="container-search__icon material-symbols-outlined">search</span>
            <form method="GET" action="{{ route('consultas') }}" class="form-buscar">
                <input id="searchCedula" class="container-search__bar" type="text" name="buscar" placeholder="Buscar por cédula o nombre..." value="{{ $buscar }}">
                <button type="submit" class="container-search__btn">Buscar</button>
            </form>
        </div>

        {{-- Mensaje inicial para médico si no ha buscado --}}
        @if (!$buscar)
            <div id="mensajeBuscarPaciente" style="text-align: center; margin-top: 20px;">
                <span>Por favor, ingrese los datos para buscar un historial.</span>
            </div>
        @endif
    @endif

    {{-- LISTADO DE RESULTADOS --}}
    <div id="view-perfil" class="view" style="margin-top: 20px;">
        @forelse ($consultas as $index => $consulta)
            <div class="card-consulta " id="card-{{ $index }}">
                <h2>Cédula Paciente: {{ $consulta->cedula }}</h2>
                <p><strong>Paciente:</strong> {{ $consulta->nombre }} {{ $consulta->apellido }}</p>
                <p><strong>Doctor:</strong> {{ $consulta->nombre_doctor }} </p>
                <p><strong>Fecha Consulta:</strong> {{ $consulta->fecha_consulta }}</p>
                <p><strong>Especialidad:</strong> {{ $consulta->especialidad }}</p>
                <p><strong>Motivo:</strong> {{ $consulta->motivo }}</p>
                <p><strong>Tratamiento:</strong> {{ $consulta->tratamiento }}</p>
                <button type="button" class="btn-download" onclick="exportarPDF('card-{{ $index }}', '{{ $consulta->cedula }}')">
            Descargar PDF
        </button>
            </div>
        @empty
            {{-- Si se buscó algo y no hay nada, o si el paciente no tiene historial --}}
            @if ($buscar || $persona->rol === 'paciente')
                <div class="alert-info" style="text-align: center;">
                    <span>No se encontraron registros de consultas.</span>
                </div>
            @endif
        @endforelse
        
    </div>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
function exportarPDF(idElemento, cedulaPaciente) {
    const overlay = document.getElementById('pdf-loading-overlay');
    const elemento = document.getElementById(idElemento);
    const boton = elemento.querySelector('.btn-download');

    // Mostrar overlay (oculta todo)
    overlay.style.display = 'flex';

    // Pequeño retraso para asegurar que el overlay se pinte
    setTimeout(() => {
        // Aplicar clase de exportación
        elemento.classList.add('pdf-export');
        // Forzar reflow
        void elemento.offsetHeight;

        // Opciones del PDF: márgenes mínimos para que el contenido empiece arriba
        const opciones = {
            margin: [0, 0, 0, 0], // [top, right, bottom, left] en mm (puedes poner 0 si quieres)
            filename: `Consulta_${cedulaPaciente}.pdf`,
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: {
                scale: 2,
                useCORS: true,
                logging: false,
                letterRendering: true,
                 scrollY: 0, 
            },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };

        // Ocultar botón de descarga visualmente (aunque el overlay ya lo tapa)
        if (boton) boton.style.display = 'none';

        // Generar PDF
        html2pdf().set(opciones).from(elemento).save()
            .then(() => {
                // Restaurar todo
                elemento.classList.remove('pdf-export');
                if (boton) boton.style.display = 'block';
                overlay.style.display = 'none';
            })
            .catch(error => {
                console.error('Error al generar PDF:', error);
                // En caso de error, restaurar también
                elemento.classList.remove('pdf-export');
                if (boton) boton.style.display = 'block';
                overlay.style.display = 'none';
                alert('Hubo un error al generar el PDF. Intenta de nuevo.');
            });
    }, 1000); // 50ms es suficiente para que el overlay aparezca
}
</script>
@endsection