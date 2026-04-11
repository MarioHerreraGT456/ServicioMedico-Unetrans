<?php $__env->startSection('content'); ?>
<div id="pdf-alert" style="display: none; background: #d1fae5; color: #065f46; border: 1px solid #10b981; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-weight: 500;">
        <i class='bx bx-cloud-download'></i> ¡Descarga con éxito! El reporte se ha generado correctamente.
    </div>
<div class="dashboard-estadisticas">
    <h1 class="titulo-principal">Panel de Estadísticas Médicas</h1>

    <div class="fila-kpis">
        <div class="card-kpi">
            <div class="card-kpi__icon blue">
                <i class='bx bx-plus-medical'></i>
            </div>
            <div class="card-kpi__content">
                <h4>Total Consultas</h4>
                <div class="numero"><?php echo e($totalConsultas); ?></div>
            </div>
        </div>

        <div class="card-kpi">
            <div class="card-kpi__icon green">
                <i class='fa-solid fa-user'></i>
            </div>
            <div class="card-kpi__content">
                <h4>Total Visitantes</h4>
                <div class="numero"><?php echo e($totalVisitantes); ?></div>
            </div>
        </div>

        <div class="card-kpi">
            <div class="card-kpi__icon general">
                <i class='fa-solid fa-hospital'></i>
            </div>
            <div class="card-kpi__content">
                <h4>Total Medicina General</h4>
                <div class="numero"><?php echo e($totalGeneral); ?></div>
            </div>
        </div>

        <div class="card-kpi">
            <div class="card-kpi__icon odonto">
                <i class='fa-solid fa-tooth'></i>
            </div>
            <div class="card-kpi__content">
                <h4>Total Odontología</h4>
                <div class="numero"><?php echo e($totalOdontologia); ?></div>
            </div>
        </div>

        <div class="card-kpi">
            <div class="card-kpi__icon psiq">
                <i class='fa-solid fa-brain'></i>
            </div>
            <div class="card-kpi__content">
                <h4>Total Psiquiatría</h4>
                <div class="numero"><?php echo e($totalPsiquiatria); ?></div>
            </div>
        </div>

        <div class="card-kpi">
            <div class="card-kpi__icon fisio">
                <i class='fa-solid fa-person-running'></i>
            </div>
            <div class="card-kpi__content">
                <h4>Total Fisiatría</h4>
                <div class="numero"><?php echo e($totalFisiatria); ?></div>
            </div>
        </div>

        <div class="card-kpi">
            <div class="card-kpi__icon trauma">
                <i class='fa-solid fa-bone'></i>
            </div>
            <div class="card-kpi__content">
                <h4>Total Traumatología</h4>
                <div class="numero"><?php echo e($totalTraumatologia); ?></div>
            </div>
        </div>
    </div>


    <div class="grid-graficas">
        <div class="panel">
            <h3>Consultas por Módulo</h3>
            <canvas id="graficaEspecialidades"></canvas>
        </div>

        <div class="panel">
            <h3>Distribución Total por Especialidad</h3>
            <canvas id="graficaDonaEspecialidades"></canvas>
        </div>
    </div>


    <div class="grid-graficas-abajo">
        <div class="panel">
            <h3>Medicina General por Tipo de Consulta</h3>
            <canvas id="graficaGeneralTipos"></canvas>
        </div>

        <div class="panel">
            <h3>Pacientes por Especialidad</h3>
            <canvas id="graficaComparativaTipos"></canvas>
        </div>
    </div>

    <div class="contenedor-estadisticas">

        <div class="cuadro-estadistica cuadro-estadistica--ancha general">
            <h3><i class='fa-solid fa-hospital'></i> Medicina General</h3>

            <div class="dato"><span>Obreros:</span> <span class="valor"><?php echo e($generalObrero); ?></span></div>
            <div class="dato"><span>Docentes:</span> <span class="valor"><?php echo e($generalDocente); ?></span></div>
            <div class="dato"><span>Administrativos:</span> <span class="valor"><?php echo e($generalAdministrativo); ?></span></div>
            <div class="dato"><span>Estudiantes:</span> <span class="valor"><?php echo e($generalEstudiante); ?></span></div>
            <div class="dato"><span>Visitantes:</span> <span class="valor"><?php echo e($totalVisitantesGeneral); ?></span></div>
        </div>

        <div class="cuadro-estadistica cuadro-estadistica--ancha tipos">
            <h3><i class='fa-solid fa-notes-medical'></i>Tipos de Consultas</h3>

            <div class="dato"><span>Total Consultas:</span> <span class="valor"><?php echo e($totalGeneral); ?></span></div>
            <div class="dato"><span>Control Niños:</span> <span class="valor"><?php echo e($totalNiños); ?></span></div>
            <div class="dato"><span>Parto Humanizado:</span> <span class="valor"><?php echo e($totalParto); ?></span></div>
            <div class="dato"><span>Pesquisa CA:</span> <span class="valor"><?php echo e($totalPesquisa); ?></span></div>
            <div class="dato"><span>Apoyo Vital:</span> <span class="valor"><?php echo e($totalVital); ?></span></div>
        </div>

        <div class="cuadro-estadistica cuadro-estadistica--compacta odontologia">
            <h3><i class='fa-solid fa-tooth'></i> Odontología</h3>

            <div class="dato"><span>Total Consultas:</span> <span class="valor"><?php echo e($totalOdontologia); ?></span></div>
            <div class="dato"><span>Obreros:</span> <span class="valor"><?php echo e($odontologiaObrero); ?></span></div>
            <div class="dato"><span>Docentes:</span> <span class="valor"><?php echo e($odontologiaDocente); ?></span></div>
            <div class="dato"><span>Administrativos:</span> <span class="valor"><?php echo e($odontologiaAdministrativo); ?></span></div>
            <div class="dato"><span>Estudiantes:</span> <span class="valor"><?php echo e($odontologiaEstudiante); ?></span></div>
            <div class="dato"><span>Visitantes:</span> <span class="valor"><?php echo e($totalVisitantesOdontologia); ?></span></div>
        </div>

        <div class="cuadro-estadistica cuadro-estadistica--compacta psiquiatria">
            <h3><i class='fa-solid fa-brain'></i> Psiquiatría</h3>

            <div class="dato"><span>Total Consultas:</span> <span class="valor"><?php echo e($totalPsiquiatria); ?></span></div>
            <div class="dato"><span>Obreros:</span> <span class="valor"><?php echo e($psiquiatriaObrero); ?></span></div>
            <div class="dato"><span>Docentes:</span> <span class="valor"><?php echo e($psiquiatriaDocente); ?></span></div>
            <div class="dato"><span>Administrativos:</span> <span class="valor"><?php echo e($psiquiatriaAdministrativo); ?></span></div>
            <div class="dato"><span>Estudiantes:</span> <span class="valor"><?php echo e($psiquiatriaEstudiante); ?></span></div>
            <div class="dato"><span>Visitantes:</span> <span class="valor"><?php echo e($totalVisitantesPsiquiatria); ?></span></div>
        </div>

        <div class="cuadro-estadistica cuadro-estadistica--compacta fisiatria">
            <h3><i class='fa-solid fa-person-running'></i> Fisiatría</h3>

            <div class="dato"><span>Total Consultas:</span> <span class="valor"><?php echo e($totalFisiatria); ?></span></div>
            <div class="dato"><span>Obreros:</span> <span class="valor"><?php echo e($fisiatriaObrero); ?></span></div>
            <div class="dato"><span>Docentes:</span> <span class="valor"><?php echo e($fisiatriaDocente); ?></span></div>
            <div class="dato"><span>Administrativos:</span> <span class="valor"><?php echo e($fisiatriaAdministrativo); ?></span></div>
            <div class="dato"><span>Estudiantes:</span> <span class="valor"><?php echo e($fisiatriaEstudiante); ?></span></div>
            <div class="dato"><span>Visitantes:</span> <span class="valor"><?php echo e($totalVisitantesFisiatria); ?></span></div>
        </div>

        <div class="cuadro-estadistica cuadro-estadistica--compacta traumatologia">
            <h3><i class='fa-solid fa-bone'></i> Traumatología</h3>

            <div class="dato"><span>Total Consultas:</span> <span class="valor"><?php echo e($totalTraumatologia); ?></span></div>
            <div class="dato"><span>Obreros:</span> <span class="valor"><?php echo e($traumatologiaObrero); ?></span></div>
            <div class="dato"><span>Docentes:</span> <span class="valor"><?php echo e($traumatologiaDocente); ?></span></div>
            <div class="dato"><span>Administrativos:</span> <span class="valor"><?php echo e($traumatologiaAdministrativo); ?></span></div>
            <div class="dato"><span>Estudiantes:</span> <span class="valor"><?php echo e($traumatologiaEstudiante); ?></span></div>
            <div class="dato"><span>Visitantes:</span> <span class="valor"><?php echo e($totalVisitantesTraumatologia); ?></span></div>
        </div>

        <div class="cuadro-estadistica cuadro-estadistica--ancha cuadro-estadistica--centrada resumen">
            <h3><i class='bx bx-bar-chart-alt-2'></i>Resumen Global</h3>

            <div class="dato"><span>Total Visitantes (Todos):</span> <span class="valor"><?php echo e($totalVisitantes); ?></span></div>

            <div class="dato" style="font-size: 1.2em; margin-top: 10px;">
                <span>TOTAL CONSULTAS:</span>
                <span class="valor"><?php echo e($totalConsultas); ?></span>
            </div>
        </div>

    </div>
    <a href="<?php echo e(route('estadisticas.pdf')); ?>" 
           onclick="mostrarExito()"
           class="btn-descarga" 
           style="background: #10b981; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; display: flex; align-items: center; gap: 8px; font-weight: bold; border: none; cursor: pointer;">
            <i class='bx bxs-file-pdf'></i> Descargar Datos PDF
        </a>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function mostrarExito() {
        const alerta = document.getElementById('pdf-alert');
        alerta.style.display = 'block';

        // Desaparece tras 5 segundos
        setTimeout(() => {
            alerta.style.display = 'none';
        }, 5000);
    }
</script>

<script>
    const especialidadesLabels = ['Medicina General', 'Odontología', 'Psiquiatría', 'Fisiatría', 'Traumatología'];
    const especialidadesData = [
        <?php echo e($totalGeneral); ?>,
        <?php echo e($totalOdontologia); ?>,
        <?php echo e($totalPsiquiatria); ?>,
        <?php echo e($totalFisiatria); ?>,
        <?php echo e($totalTraumatologia); ?>

    ];

    new Chart(document.getElementById('graficaEspecialidades'), {
        type: 'bar',
        data: {
            labels: especialidadesLabels,
            datasets: [{
                label: 'Total de consultas',
                data: especialidadesData,
                backgroundColor: ['#2563eb', '#14b8a6', '#8b5cf6', '#f59e0b', '#ef4444'],
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });

    new Chart(document.getElementById('graficaDonaEspecialidades'), {
        type: 'doughnut',
        data: {
            labels: especialidadesLabels,
            datasets: [{
                data: especialidadesData,
                backgroundColor: ['#2563eb', '#14b8a6', '#8b5cf6', '#f59e0b', '#ef4444']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    new Chart(document.getElementById('graficaGeneralTipos'), {
        type: 'line',
        data: {
            labels: ['Niños', 'Parto', 'Pesquisa', 'Vital'],
            datasets: [{
                label: 'Medicina general',
                data: [
                    <?php echo e($totalNiños); ?>,
                    <?php echo e($totalParto); ?>,
                    <?php echo e($totalPesquisa); ?>,
                    <?php echo e($totalVital); ?>

                ],
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.15)',
                tension: 0.4,
                fill: true,
                pointRadius: 5,
                pointBackgroundColor: '#10b981'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });

    new Chart(document.getElementById('graficaComparativaTipos'), {
        type: 'line',
        data: {
            labels: ['Obrero', 'Docente', 'Administrativo', 'Estudiante', 'Visitantes'],
            datasets: [
                {
                    label: 'Psiquiatría',
                    data: [
                        <?php echo e($psiquiatriaObrero); ?>,
                        <?php echo e($psiquiatriaDocente); ?>,
                        <?php echo e($psiquiatriaAdministrativo); ?>,
                        <?php echo e($psiquiatriaEstudiante); ?>,
                        <?php echo e($totalVisitantesPsiquiatria); ?>

                    ],
                    borderColor: '#8b5cf6',
                    backgroundColor: 'rgba(139, 92, 246, 0.1)',
                    tension: 0.4,
                    fill: false,
                    pointRadius: 4
                },
                {
                    label: 'Fisiatría',
                    data: [
                        <?php echo e($fisiatriaObrero); ?>,
                        <?php echo e($fisiatriaDocente); ?>,
                        <?php echo e($fisiatriaAdministrativo); ?>,
                        <?php echo e($fisiatriaEstudiante); ?>,
                        <?php echo e($totalVisitantesFisiatria); ?>

                    ],
                    borderColor: '#f59e0b',
                    backgroundColor: 'rgba(245, 158, 11, 0.1)',
                    tension: 0.4,
                    fill: false,
                    pointRadius: 4
                },
                {
                    label: 'Traumatología',
                    data: [
                        <?php echo e($traumatologiaObrero); ?>,
                        <?php echo e($traumatologiaDocente); ?>,
                        <?php echo e($traumatologiaAdministrativo); ?>,
                        <?php echo e($traumatologiaEstudiante); ?>,
                        <?php echo e($totalVisitantesTraumatologia); ?>

                    ],
                    borderColor: '#ef4444',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    tension: 0.4,
                    fill: false,
                    pointRadius: 4
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Unetrans\resources\views/estadisticas.blade.php ENDPATH**/ ?>