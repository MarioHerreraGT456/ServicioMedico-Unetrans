<?php $__env->startSection('content'); ?>
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
<main class="main-content">
    <h1 class="hero__title-historial">Historias</h1>

    <div class="container-search" style="margin-bottom: 20px;">
        <span class="container-search__icon material-symbols-outlined">search</span>
        <form method="GET" action="<?php echo e(route('historias')); ?>" class="form-buscar">
            <input class="container-search__bar" type="text" name="buscar" placeholder="Cédula o nombre..." value="<?php echo e($buscar); ?>">
            <button type="submit" class="container-search__btn">Buscar</button>
        </form>
    </div>

    <div id="view-perfil" class="view">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $consultas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $consulta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
    <div class="card-consulta" id="card-<?php echo e($index); ?>">
        <h3><?php echo e($consulta->nombre); ?> <?php echo e($consulta->apellido); ?> (<?php echo e($consulta->especialidad); ?>)</h3>
        
        <div class="info-grid">
            <p><strong>Cédula:</strong> <?php echo e($consulta->tipo); ?>-<?php echo e($consulta->cedula); ?></p>
            <p><strong>Teléfono:</strong> <?php echo e($consulta->telefono); ?></p>
            <p><strong>Sexo:</strong> <?php echo e($consulta->sexo); ?></p>
            <p><strong>Dirección:</strong> <?php echo e($consulta->direccion); ?></p>
            <p><strong>Fecha de Nacimiento:</strong> <?php echo e($consulta->fecha_nacimiento); ?></p>
            
            <p><strong>Enfermedad:</strong> <?php echo e($consulta->enfermedad); ?></p>
            <p><strong>Motivo:</strong> <?php echo e($consulta->motivo_consulta); ?></p>
            <p><strong>Antecedentes Familiares:</strong> <?php echo e($consulta->antecedentes_familiares); ?></p>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($consulta->especialidad === 'Odontología'): ?>
            <div class="dental-info" style="background: #f0f7ff; padding: 10px; margin-top: 10px;">
                <?php
                    $dientesArray = json_decode($consulta->diente, true);
                    if (is_string($dientesArray)) {
                        $dientesArray = json_decode($dientesArray, true);
                    }
                ?>
        
                <div class="card-odontograma" data-dientes-seleccionados="<?php echo e($consulta->diente); ?>">
                    <div class="dientes-block">
                        <div class="campo odontologia-section">
                            <input type="hidden" id="input_diente" name="dientes" value="<?php echo e(old('dientes')); ?>">

                            <div class="odontograma-container2">
                                <div class="fila-dientes">
                                    <div class="cuadrante cuadrante-izq">
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="18"><img src="img/18.png" alt=""></button>
                                            18
                                        </div>
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="17"><img src="img/17.png" alt=""></button>
                                            17
                                        </div>
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="16"><img src="img/16.png" alt=""></button>
                                            16
                                        </div>
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="15"><img src="img/15.png" alt=""></button>
                                            15
                                        </div>
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="14"><img src="img/14.png" alt=""></button>
                                            14
                                        </div>
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="13"><img src="img/13.png" alt=""></button>
                                            13
                                        </div>
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="12"><img src="img/12.png" alt=""></button>
                                            12
                                        </div>
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="11"><img src="img/11.png" alt=""></button>
                                            11
                                        </div>
                                    </div>
                                    <div class="cuadrante cuadrante-der">
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="21"><img src="img/21.png" alt=""></button>
                                            21
                                        </div>
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="22"><img src="img/22.png" alt=""></button>
                                            22
                                        </div>
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="23"><img src="img/23.png" alt=""></button>
                                            23
                                        </div>
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="24"><img src="img/24.png" alt=""></button>
                                            24
                                        </div>
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="25"><img src="img/25.png" alt=""></button>
                                            25
                                        </div>
                                        <div class="diente-center">
                                             <button type="button" class="btn-diente" data-diente="26"><img src="img/26.png" alt=""></button>
                                            26
                                        </div>
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="27"><img src="img/27.png" alt=""></button>
                                            27
                                        </div>
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="28"><img src="img/28.png" alt=""></button>
                                            28
                                        </div>
                                    </div>
                                </div>

                                <div class="fila-dientes">
                                    <div class="cuadrante cuadrante-izq">
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="48"><img src="img/48.png" alt=""></button>
                                            48
                                        </div>
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="47"><img src="img/47.png" alt=""></button>
                                            47
                                        </div>
                                        <div class="diente-center">
                                             <button type="button" class="btn-diente" data-diente="46"><img src="img/46.png" alt=""></button>
                                            46
                                        </div>
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="45"><img src="img/45.png" alt=""></button>
                                            45
                                        </div>
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="44"><img src="img/44.png" alt=""></button>
                                            44
                                        </div>
                                        <div class="diente-center">
                                             <button type="button" class="btn-diente" data-diente="43"><img src="img/43.png" alt=""></button>
                                            43
                                        </div>
                                        <div class="diente-center">
                                             <button type="button" class="btn-diente" data-diente="42"><img src="img/42.png" alt=""></button>
                                            42
                                        </div>
                                        <div class="diente-center">
                                             <button type="button" class="btn-diente" data-diente="41"><img src="img/41.png" alt=""></button>
                                            41
                                        </div>
                                    </div>
                                    <div class="cuadrante cuadrante-der">
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="31"><img src="img/31.png" alt=""></button>
                                            31
                                        </div>
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="32"><img src="img/32.png" alt=""></button>
                                            32
                                        </div>
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="33"><img src="img/33.png" alt=""></button>
                                            33
                                        </div>
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="34"><img src="img/34.png" alt=""></button>
                                            34
                                        </div>
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="35"><img src="img/35.png" alt=""></button>
                                            35
                                        </div>
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="36"><img src="img/36.png" alt=""></button>
                                            36
                                        </div>
                                        <div class="diente-center">
                                             <button type="button" class="btn-diente" data-diente="37"><img src="img/37.png" alt=""></button>
                                            37
                                        </div>
                                        <div class="diente-center">
                                            <button type="button" class="btn-diente" data-diente="38"><img src="img/38.png" alt=""></button>
                                            38
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div> 
                    </div> 
                    <p><strong>Examen Bucal:</strong> <?php echo e($consulta->examen); ?></p>
                </div> 
            </div> 
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php
            $antecedentesArray = json_decode($consulta->antecedentes_personales, true);
            if (is_string($antecedentesArray)) {
                $antecedentesArray = json_decode($antecedentesArray, true);
            }
            $antecedentesTexto = is_array($antecedentesArray) && !empty($antecedentesArray) 
                                 ? implode(', ', array_map('ucfirst', $antecedentesArray)) 
                                 : 'Ninguno';
        ?>

        <p><strong>Antecedentes Personales:</strong> <?php echo e($antecedentesTexto); ?></p>
        <p><strong>Tratamiento:</strong> <?php echo e($consulta->tratamiento); ?></p>
        <button type="button" class="btn-download" onclick="exportarPDF('card-<?php echo e($index); ?>', '<?php echo e($consulta->cedula); ?>')">
            Descargar PDF
        </button>
    </div>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const secciones = document.querySelectorAll('.card-odontograma');
    secciones.forEach(seccion => {
        const rawData = seccion.getAttribute('data-dientes-seleccionados');
        try {
            let dientesArray = JSON.parse(rawData);
            if (typeof dientesArray === 'string') {
                dientesArray = JSON.parse(dientesArray);
            }
            if (Array.isArray(dientesArray)) {
                dientesArray.forEach(numeroDiente => {
                    const boton = seccion.querySelector(`.btn-diente[data-diente="${numeroDiente}"]`);
                    if (boton) {
                        boton.classList.add('activo');
                    }
                });
            }
        } catch (e) {
            console.error("Error al procesar dientes para colorear", e);
        }
    });
});
</script>
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
            margin: [0, 0, 0, 0], // [top, right, bottom, left] en mm
            filename: `Historia_${cedulaPaciente}.pdf`,
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
    }, 1000); 
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Unetrans\resources\views/historias.blade.php ENDPATH**/ ?>