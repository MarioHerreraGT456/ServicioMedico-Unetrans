@extends('layouts.app')

@section('content')
<style>
    .contenedor-estadisticas {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        padding: 20px;
        font-family: sans-serif;
    }

    .cuadro-estadistica {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 15px;
        background-color: #f9f9f9;
        box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
    }

    .cuadro-estadistica h3 {
        margin-top: 0;
        border-bottom: 2px solid #276fc2;
        padding-bottom: 5px;
        color: #333;
    }

    .dato {
        display: flex;
        justify-content: space-between;
        margin: 8px 0;
        font-size: 1.1em;
    }

    .valor {
        font-weight: bold;
        color: #276fc2;
    }

    .titulo-principal {
        text-align: center;
        margin-top: 20px;
        color: #276fc2;
    }
</style>

<h1 class="titulo-principal">Panel de Estadísticas Médicas</h1>

<div class="contenedor-estadisticas">

    <div class="cuadro-estadistica">
        <h3>Medicina General</h3>
        <div class="dato"><span>Total Consultas:</span> <span class="valor">{{ $totalGeneral }}</span></div>
        <div class="dato"><span>Control Niños:</span> <span class="valor">{{ $totalNiños }}</span></div>
        <div class="dato"><span>Parto Humanizado:</span> <span class="valor">{{ $totalParto }}</span></div>
        <div class="dato"><span>Pesquisa CA:</span> <span class="valor">{{ $totalPesquisa }}</span></div>
        <div class="dato"><span>Apoyo Vital:</span> <span class="valor">{{ $totalVital }}</span></div>
        <hr>
        <div class="dato"><span>Obreros:</span> <span class="valor">{{ $generalObrero }}</span></div>
        <div class="dato"><span>Docentes:</span> <span class="valor">{{ $generalDocente }}</span></div>
        <div class="dato"><span>Administrativos:</span> <span class="valor">{{ $generalAdministrativo }}</span></div>
        <div class="dato"><span>Estudiantes:</span> <span class="valor">{{ $generalEstudiante }}</span></div>
        <div class="dato"><span>Visitantes:</span> <span class="valor">{{ $totalVisitantesGeneral }}</span></div>
    </div>

    <div class="cuadro-estadistica">
        <h3>Odontología</h3>
        <div class="dato"><span>Total Consultas:</span> <span class="valor">{{ $totalOdontologia }}</span></div>
        <div class="dato"><span>Obreros:</span> <span class="valor">{{ $odontologiaObrero }}</span></div>
        <div class="dato"><span>Docentes:</span> <span class="valor">{{ $odontologiaDocente }}</span></div>
        <div class="dato"><span>Administrativos:</span> <span class="valor">{{ $odontologiaAdministrativo }}</span></div>
        <div class="dato"><span>Estudiantes:</span> <span class="valor">{{ $odontologiaEstudiante }}</span></div>
        <div class="dato"><span>Visitantes:</span> <span class="valor">{{ $totalVisitantesOdontologia }}</span></div>
    </div>

    <div class="cuadro-estadistica">
        <h3>Psiquiatría</h3>
        <div class="dato"><span>Total Consultas:</span> <span class="valor">{{ $totalPsiquiatria }}</span></div>
        <div class="dato"><span>Obreros:</span> <span class="valor">{{ $psiquiatriaObrero }}</span></div>
        <div class="dato"><span>Docentes:</span> <span class="valor">{{ $psiquiatriaDocente }}</span></div>
        <div class="dato"><span>Administrativos:</span> <span class="valor">{{ $psiquiatriaAdministrativo }}</span></div>
        <div class="dato"><span>Estudiantes:</span> <span class="valor">{{ $psiquiatriaEstudiante }}</span></div>
        <div class="dato"><span>Visitantes:</span> <span class="valor">{{ $totalVisitantesPsiquiatria }}</span></div>
    </div>

    <div class="cuadro-estadistica">
        <h3>Fisiatría</h3>
        <div class="dato"><span>Total Consultas:</span> <span class="valor">{{ $totalFisiatria }}</span></div>
        <div class="dato"><span>Obreros:</span> <span class="valor">{{ $fisiatriaObrero }}</span></div>
        <div class="dato"><span>Docentes:</span> <span class="valor">{{ $fisiatriaDocente }}</span></div>
        <div class="dato"><span>Administrativos:</span> <span class="valor">{{ $fisiatriaAdministrativo }}</span></div>
        <div class="dato"><span>Estudiantes:</span> <span class="valor">{{ $fisiatriaEstudiante }}</span></div>
        <div class="dato"><span>Visitantes:</span> <span class="valor">{{ $totalVisitantesFisiatria }}</span></div>
    </div>

    <div class="cuadro-estadistica">
        <h3>Traumatología</h3>
        <div class="dato"><span>Total Consultas:</span> <span class="valor">{{ $totalTraumatologia }}</span></div>
        <div class="dato"><span>Obreros:</span> <span class="valor">{{ $traumatologiaObrero }}</span></div>
        <div class="dato"><span>Docentes:</span> <span class="valor">{{ $traumatologiaDocente }}</span></div>
        <div class="dato"><span>Administrativos:</span> <span class="valor">{{ $traumatologiaAdministrativo }}</span></div>
        <div class="dato"><span>Estudiantes:</span> <span class="valor">{{ $traumatologiaEstudiante }}</span></div>
        <div class="dato"><span>Visitantes:</span> <span class="valor">{{ $totalVisitantesTraumatologia }}</span></div>
    </div>

    <div class="cuadro-estadistica" style="background-color: #e3f2fd; border-color: #276fc2;">
        <h3>Resumen Global</h3>
        <div class="dato"><span>Total Visitantes (Todos):</span> <span class="valor">{{ $totalVisitantes }}</span></div>
        <div class="dato" style="font-size: 1.3em; margin-top: 15px;">
            <span>TOTAL CONSULTAS:</span> 
            <span class="valor">{{ $totalConsultas }}</span>
        </div>
    </div>

</div>
@endsection