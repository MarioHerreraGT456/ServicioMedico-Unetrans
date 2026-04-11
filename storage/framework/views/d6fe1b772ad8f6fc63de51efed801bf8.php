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
    <p>Fecha de emisión: <?php echo e(now()->format('d/m/Y H:i')); ?></p>
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
        <tr><td class="text-left">Medicina General</td><td><?php echo e($totalGeneral); ?></td></tr>
        <tr><td class="text-left">Odontología</td><td><?php echo e($totalOdontologia); ?></td></tr>
        <tr><td class="text-left">Psiquiatría</td><td><?php echo e($totalPsiquiatria); ?></td></tr>
        <tr><td class="text-left">Fisiatría</td><td><?php echo e($totalFisiatria); ?></td></tr>
        <tr><td class="text-left">Traumatología</td><td><?php echo e($totalTraumatologia); ?></td></tr>
        <tr class="total-row"><td class="text-left">TOTAL VISITANTES</td><td><?php echo e($totalVisitantes); ?></td></tr>
        <tr class="total-row"><td class="text-left">TOTAL GLOBAL</td><td><?php echo e($totalConsultas); ?></td></tr>
    
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
            <td><?php echo e($generalObrero); ?></td><td><?php echo e($generalDocente); ?></td><td><?php echo e($generalAdministrativo); ?></td>
            <td><?php echo e($generalEstudiante); ?></td><td><?php echo e($totalVisitantesGeneral); ?></td>
            <td><strong><?php echo e($totalGeneral); ?></strong></td>
        </tr>
        <tr>
            <td class="text-left">Odontología</td>
            <td><?php echo e($odontologiaObrero); ?></td><td><?php echo e($odontologiaDocente); ?></td><td><?php echo e($odontologiaAdministrativo); ?></td>
            <td><?php echo e($odontologiaEstudiante); ?></td><td><?php echo e($totalVisitantesOdontologia); ?></td>
            <td><strong><?php echo e($totalOdontologia); ?></strong></td>
        </tr>
        <tr>
            <td class="text-left">Psiquiatría</td>
            <td><?php echo e($psiquiatriaObrero); ?></td><td><?php echo e($psiquiatriaDocente); ?></td><td><?php echo e($psiquiatriaAdministrativo); ?></td>
            <td><?php echo e($psiquiatriaEstudiante); ?></td><td><?php echo e($totalVisitantesPsiquiatria); ?></td>
            <td><strong><?php echo e($totalPsiquiatria); ?></strong></td>
        </tr>
        <tr>
            <td class="text-left">Fisiatría</td>
            <td><?php echo e($fisiatriaObrero); ?></td><td><?php echo e($fisiatriaDocente); ?></td><td><?php echo e($fisiatriaAdministrativo); ?></td>
            <td><?php echo e($fisiatriaEstudiante); ?></td><td><?php echo e($totalVisitantesFisiatria); ?></td>
            <td><strong><?php echo e($totalFisiatria); ?></strong></td>
        </tr>
        <tr>
            <td class="text-left">Traumatología</td>
            <td><?php echo e($traumatologiaObrero); ?></td><td><?php echo e($traumatologiaDocente); ?></td><td><?php echo e($traumatologiaAdministrativo); ?></td>
            <td><?php echo e($traumatologiaEstudiante); ?></td><td><?php echo e($totalVisitantesTraumatologia); ?></td>
            <td><strong><?php echo e($totalTraumatologia); ?></strong></td>
        </tr>
    </tbody>
</table>

<h3>3. Tipos de Consulta (Medicina General)</h3>
<table class="resumen">
    <tr><th class="text-left">Categoría</th><th>Cantidad</th></tr>
    <tr><td class="text-left">Control Niños</td><td><?php echo e($totalNiños); ?></td></tr>
    <tr><td class="text-left">Parto Humanizado</td><td><?php echo e($totalParto); ?></td></tr>
    <tr><td class="text-left">Pesquisa CA</td><td><?php echo e($totalPesquisa); ?></td></tr>
    <tr><td class="text-left">Apoyo Vital</td><td><?php echo e($totalVital); ?></td></tr>
</table>
</body>
</html><?php /**PATH C:\xampp\htdocs\Unetrans\resources\views/pdf_export.blade.php ENDPATH**/ ?>