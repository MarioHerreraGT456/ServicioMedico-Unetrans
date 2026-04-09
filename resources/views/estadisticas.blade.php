@extends('layouts.app')

@section('content')
<div class="dashboard-estadisticas">
    <h1 class="titulo-principal">Panel de Estadísticas Médicas</h1>

    <div class="fila-kpis">
        <div class="card-kpi">
            <div class="card-kpi__icon blue">
                <i class='bx bx-plus-medical'></i>
            </div>
            <div class="card-kpi__content">
                <h4>Total Consultas</h4>
                <div class="numero">{{ $totalConsultas }}</div>
            </div>
        </div>

        <div class="card-kpi">
            <div class="card-kpi__icon green">
                <i class='fa-solid fa-user'></i>
            </div>
            <div class="card-kpi__content">
                <h4>Total Visitantes</h4>
                <div class="numero">{{ $totalVisitantes }}</div>
            </div>
        </div>

        <div class="card-kpi">
            <div class="card-kpi__icon general">
                <i class='fa-solid fa-hospital'></i>
            </div>
            <div class="card-kpi__content">
                <h4>Total Medicina General</h4>
                <div class="numero">{{ $totalGeneral }}</div>
            </div>
        </div>

        <div class="card-kpi">
            <div class="card-kpi__icon odonto">
                <i class='fa-solid fa-tooth'></i>
            </div>
            <div class="card-kpi__content">
                <h4>Total Odontología</h4>
                <div class="numero">{{ $totalOdontologia }}</div>
            </div>
        </div>

        <div class="card-kpi">
            <div class="card-kpi__icon psiq">
                <i class='fa-solid fa-brain'></i>
            </div>
            <div class="card-kpi__content">
                <h4>Total Psiquiatría</h4>
                <div class="numero">{{ $totalPsiquiatria }}</div>
            </div>
        </div>

        <div class="card-kpi">
            <div class="card-kpi__icon fisio">
                <i class='fa-solid fa-person-running'></i>
            </div>
            <div class="card-kpi__content">
                <h4>Total Fisiatría</h4>
                <div class="numero">{{ $totalFisiatria }}</div>
            </div>
        </div>

        <div class="card-kpi">
            <div class="card-kpi__icon trauma">
                <i class='fa-solid fa-bone'></i>
            </div>
            <div class="card-kpi__content">
                <h4>Total Traumatología</h4>
                <div class="numero">{{ $totalTraumatologia }}</div>
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

            <div class="dato"><span>Obreros:</span> <span class="valor">{{ $generalObrero }}</span></div>
            <div class="dato"><span>Docentes:</span> <span class="valor">{{ $generalDocente }}</span></div>
            <div class="dato"><span>Administrativos:</span> <span class="valor">{{ $generalAdministrativo }}</span></div>
            <div class="dato"><span>Estudiantes:</span> <span class="valor">{{ $generalEstudiante }}</span></div>
            <div class="dato"><span>Visitantes:</span> <span class="valor">{{ $totalVisitantesGeneral }}</span></div>
        </div>

        <div class="cuadro-estadistica cuadro-estadistica--ancha tipos">
            <h3><i class='fa-solid fa-notes-medical'></i>Tipos de Consultas</h3>

            <div class="dato"><span>Total Consultas:</span> <span class="valor">{{ $totalGeneral }}</span></div>
            <div class="dato"><span>Control Niños:</span> <span class="valor">{{ $totalNiños }}</span></div>
            <div class="dato"><span>Parto Humanizado:</span> <span class="valor">{{ $totalParto }}</span></div>
            <div class="dato"><span>Pesquisa CA:</span> <span class="valor">{{ $totalPesquisa }}</span></div>
            <div class="dato"><span>Apoyo Vital:</span> <span class="valor">{{ $totalVital }}</span></div>
        </div>

        <div class="cuadro-estadistica cuadro-estadistica--compacta odontologia">
            <h3><i class='fa-solid fa-tooth'></i> Odontología</h3>

            <div class="dato"><span>Total Consultas:</span> <span class="valor">{{ $totalOdontologia }}</span></div>
            <div class="dato"><span>Obreros:</span> <span class="valor">{{ $odontologiaObrero }}</span></div>
            <div class="dato"><span>Docentes:</span> <span class="valor">{{ $odontologiaDocente }}</span></div>
            <div class="dato"><span>Administrativos:</span> <span class="valor">{{ $odontologiaAdministrativo }}</span></div>
            <div class="dato"><span>Estudiantes:</span> <span class="valor">{{ $odontologiaEstudiante }}</span></div>
            <div class="dato"><span>Visitantes:</span> <span class="valor">{{ $totalVisitantesOdontologia }}</span></div>
        </div>

        <div class="cuadro-estadistica cuadro-estadistica--compacta psiquiatria">
            <h3><i class='fa-solid fa-brain'></i> Psiquiatría</h3>

            <div class="dato"><span>Total Consultas:</span> <span class="valor">{{ $totalPsiquiatria }}</span></div>
            <div class="dato"><span>Obreros:</span> <span class="valor">{{ $psiquiatriaObrero }}</span></div>
            <div class="dato"><span>Docentes:</span> <span class="valor">{{ $psiquiatriaDocente }}</span></div>
            <div class="dato"><span>Administrativos:</span> <span class="valor">{{ $psiquiatriaAdministrativo }}</span></div>
            <div class="dato"><span>Estudiantes:</span> <span class="valor">{{ $psiquiatriaEstudiante }}</span></div>
            <div class="dato"><span>Visitantes:</span> <span class="valor">{{ $totalVisitantesPsiquiatria }}</span></div>
        </div>

        <div class="cuadro-estadistica cuadro-estadistica--compacta fisiatria">
            <h3><i class='fa-solid fa-person-running'></i> Fisiatría</h3>

            <div class="dato"><span>Total Consultas:</span> <span class="valor">{{ $totalFisiatria }}</span></div>
            <div class="dato"><span>Obreros:</span> <span class="valor">{{ $fisiatriaObrero }}</span></div>
            <div class="dato"><span>Docentes:</span> <span class="valor">{{ $fisiatriaDocente }}</span></div>
            <div class="dato"><span>Administrativos:</span> <span class="valor">{{ $fisiatriaAdministrativo }}</span></div>
            <div class="dato"><span>Estudiantes:</span> <span class="valor">{{ $fisiatriaEstudiante }}</span></div>
            <div class="dato"><span>Visitantes:</span> <span class="valor">{{ $totalVisitantesFisiatria }}</span></div>
        </div>

        <div class="cuadro-estadistica cuadro-estadistica--compacta traumatologia">
            <h3><i class='fa-solid fa-bone'></i> Traumatología</h3>

            <div class="dato"><span>Total Consultas:</span> <span class="valor">{{ $totalTraumatologia }}</span></div>
            <div class="dato"><span>Obreros:</span> <span class="valor">{{ $traumatologiaObrero }}</span></div>
            <div class="dato"><span>Docentes:</span> <span class="valor">{{ $traumatologiaDocente }}</span></div>
            <div class="dato"><span>Administrativos:</span> <span class="valor">{{ $traumatologiaAdministrativo }}</span></div>
            <div class="dato"><span>Estudiantes:</span> <span class="valor">{{ $traumatologiaEstudiante }}</span></div>
            <div class="dato"><span>Visitantes:</span> <span class="valor">{{ $totalVisitantesTraumatologia }}</span></div>
        </div>

        <div class="cuadro-estadistica cuadro-estadistica--ancha cuadro-estadistica--centrada resumen">
            <h3><i class='bx bx-bar-chart-alt-2'></i>Resumen Global</h3>

            <div class="dato"><span>Total Visitantes (Todos):</span> <span class="valor">{{ $totalVisitantes }}</span></div>

            <div class="dato" style="font-size: 1.2em; margin-top: 10px;">
                <span>TOTAL CONSULTAS:</span>
                <span class="valor">{{ $totalConsultas }}</span>
            </div>
        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const especialidadesLabels = ['Medicina General', 'Odontología', 'Psiquiatría', 'Fisiatría', 'Traumatología'];
    const especialidadesData = [
        {{ $totalGeneral }},
        {{ $totalOdontologia }},
        {{ $totalPsiquiatria }},
        {{ $totalFisiatria }},
        {{ $totalTraumatologia }}
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
                    {{ $totalNiños }},
                    {{ $totalParto }},
                    {{ $totalPesquisa }},
                    {{ $totalVital }}
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
                        {{ $psiquiatriaObrero }},
                        {{ $psiquiatriaDocente }},
                        {{ $psiquiatriaAdministrativo }},
                        {{ $psiquiatriaEstudiante }},
                        {{ $totalVisitantesPsiquiatria }}
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
                        {{ $fisiatriaObrero }},
                        {{ $fisiatriaDocente }},
                        {{ $fisiatriaAdministrativo }},
                        {{ $fisiatriaEstudiante }},
                        {{ $totalVisitantesFisiatria }}
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
                        {{ $traumatologiaObrero }},
                        {{ $traumatologiaDocente }},
                        {{ $traumatologiaAdministrativo }},
                        {{ $traumatologiaEstudiante }},
                        {{ $totalVisitantesTraumatologia }}
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

@endsection