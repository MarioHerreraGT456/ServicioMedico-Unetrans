<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; font-size: 11px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #444; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: center; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .text-left { text-align: left; padding-left: 10px; }
        .resumen { width: 50%; margin-left: 0; }
        .total-row { background-color: #eee; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
    <h1>REPORTE ESTADÍSTICO DE CONSULTAS MÉDICAS</h1>
    <p>Fecha de emisión: {{ now()->format('d/m/Y H:i') }}</p>
</div>

<h3>1. Resumen de Totales por Especialidad</h3>
<table class="resumen">
    <thead>
        <tr>
            <th class="text-left">Especialidad</th>
            <th>Total Consultas</th>
        </tr>
    </thead>
    <tbody>
        <tr><td class="text-left">Medicina General</td><td>{{ $totalGeneral }}</td></tr>
        <tr><td class="text-left">Odontología</td><td>{{ $totalOdontologia }}</td></tr>
        <tr><td class="text-left">Psiquiatría</td><td>{{ $totalPsiquiatria }}</td></tr>
        <tr><td class="text-left">Fisiatría</td><td>{{ $totalFisiatria }}</td></tr>
        <tr><td class="text-left">Traumatología</td><td>{{ $totalTraumatologia }}</td></tr>
        <tr class="total-row"><td class="text-left">TOTAL VISITANTES</td><td>{{ $totalVisitantes }}</td></tr>
        <tr class="total-row"><td class="text-left">TOTAL GLOBAL</td><td>{{ $totalConsultas }}</td></tr>
    
    </tbody>
</table>

<h3>2. Desglose Detallado por Tipo de Paciente</h3>
<table>
    <thead>
        <tr>
            <th>Especialidad</th>
            <th>Obreros</th>
            <th>Docentes</th>
            <th>Administrativos</th>
            <th>Estudiantes</th>
            <th>Visitantes</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="text-left">Medicina General</td>
            <td>{{ $generalObrero }}</td><td>{{ $generalDocente }}</td><td>{{ $generalAdministrativo }}</td>
            <td>{{ $generalEstudiante }}</td><td>{{ $totalVisitantesGeneral }}</td>
            <td><strong>{{ $totalGeneral }}</strong></td>
        </tr>
        <tr>
            <td class="text-left">Odontología</td>
            <td>{{ $odontologiaObrero }}</td><td>{{ $odontologiaDocente }}</td><td>{{ $odontologiaAdministrativo }}</td>
            <td>{{ $odontologiaEstudiante }}</td><td>{{ $totalVisitantesOdontologia }}</td>
            <td><strong>{{ $totalOdontologia }}</strong></td>
        </tr>
        <tr>
            <td class="text-left">Psiquiatría</td>
            <td>{{ $psiquiatriaObrero }}</td><td>{{ $psiquiatriaDocente }}</td><td>{{ $psiquiatriaAdministrativo }}</td>
            <td>{{ $psiquiatriaEstudiante }}</td><td>{{ $totalVisitantesPsiquiatria }}</td>
            <td><strong>{{ $totalPsiquiatria }}</strong></td>
        </tr>
        <tr>
            <td class="text-left">Fisiatría</td>
            <td>{{ $fisiatriaObrero }}</td><td>{{ $fisiatriaDocente }}</td><td>{{ $fisiatriaAdministrativo }}</td>
            <td>{{ $fisiatriaEstudiante }}</td><td>{{ $totalVisitantesFisiatria }}</td>
            <td><strong>{{ $totalFisiatria }}</strong></td>
        </tr>
        <tr>
            <td class="text-left">Traumatología</td>
            <td>{{ $traumatologiaObrero }}</td><td>{{ $traumatologiaDocente }}</td><td>{{ $traumatologiaAdministrativo }}</td>
            <td>{{ $traumatologiaEstudiante }}</td><td>{{ $totalVisitantesTraumatologia }}</td>
            <td><strong>{{ $totalTraumatologia }}</strong></td>
        </tr>
    </tbody>
</table>

<h3>3. Tipos de Consulta (Medicina General)</h3>
<table class="resumen">
    <tr><th class="text-left">Categoría</th><th>Cantidad</th></tr>
    <tr><td class="text-left">Control Niños</td><td>{{ $totalNiños }}</td></tr>
    <tr><td class="text-left">Parto Humanizado</td><td>{{ $totalParto }}</td></tr>
    <tr><td class="text-left">Pesquisa CA</td><td>{{ $totalPesquisa }}</td></tr>
    <tr><td class="text-left">Apoyo Vital</td><td>{{ $totalVital }}</td></tr>
</table>
</body>
</html>