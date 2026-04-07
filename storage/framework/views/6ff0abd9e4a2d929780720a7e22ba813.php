<?php $__env->startSection('content'); ?>
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
        <div class="dato"><span>Total Consultas:</span> <span class="valor"><?php echo e($totalGeneral); ?></span></div>
        <div class="dato"><span>Control Niños:</span> <span class="valor"><?php echo e($totalNiños); ?></span></div>
        <div class="dato"><span>Parto Humanizado:</span> <span class="valor"><?php echo e($totalParto); ?></span></div>
        <div class="dato"><span>Pesquisa CA:</span> <span class="valor"><?php echo e($totalPesquisa); ?></span></div>
        <div class="dato"><span>Apoyo Vital:</span> <span class="valor"><?php echo e($totalVital); ?></span></div>
        <hr>
        <div class="dato"><span>Obreros:</span> <span class="valor"><?php echo e($generalObrero); ?></span></div>
        <div class="dato"><span>Docentes:</span> <span class="valor"><?php echo e($generalDocente); ?></span></div>
        <div class="dato"><span>Administrativos:</span> <span class="valor"><?php echo e($generalAdministrativo); ?></span></div>
        <div class="dato"><span>Estudiantes:</span> <span class="valor"><?php echo e($generalEstudiante); ?></span></div>
        <div class="dato"><span>Visitantes:</span> <span class="valor"><?php echo e($totalVisitantesGeneral); ?></span></div>
    </div>

    <div class="cuadro-estadistica">
        <h3>Odontología</h3>
        <div class="dato"><span>Total Consultas:</span> <span class="valor"><?php echo e($totalOdontologia); ?></span></div>
        <div class="dato"><span>Obreros:</span> <span class="valor"><?php echo e($odontologiaObrero); ?></span></div>
        <div class="dato"><span>Docentes:</span> <span class="valor"><?php echo e($odontologiaDocente); ?></span></div>
        <div class="dato"><span>Administrativos:</span> <span class="valor"><?php echo e($odontologiaAdministrativo); ?></span></div>
        <div class="dato"><span>Estudiantes:</span> <span class="valor"><?php echo e($odontologiaEstudiante); ?></span></div>
        <div class="dato"><span>Visitantes:</span> <span class="valor"><?php echo e($totalVisitantesOdontologia); ?></span></div>
    </div>

    <div class="cuadro-estadistica">
        <h3>Psiquiatría</h3>
        <div class="dato"><span>Total Consultas:</span> <span class="valor"><?php echo e($totalPsiquiatria); ?></span></div>
        <div class="dato"><span>Obreros:</span> <span class="valor"><?php echo e($psiquiatriaObrero); ?></span></div>
        <div class="dato"><span>Docentes:</span> <span class="valor"><?php echo e($psiquiatriaDocente); ?></span></div>
        <div class="dato"><span>Administrativos:</span> <span class="valor"><?php echo e($psiquiatriaAdministrativo); ?></span></div>
        <div class="dato"><span>Estudiantes:</span> <span class="valor"><?php echo e($psiquiatriaEstudiante); ?></span></div>
        <div class="dato"><span>Visitantes:</span> <span class="valor"><?php echo e($totalVisitantesPsiquiatria); ?></span></div>
    </div>

    <div class="cuadro-estadistica">
        <h3>Fisiatría</h3>
        <div class="dato"><span>Total Consultas:</span> <span class="valor"><?php echo e($totalFisiatria); ?></span></div>
        <div class="dato"><span>Obreros:</span> <span class="valor"><?php echo e($fisiatriaObrero); ?></span></div>
        <div class="dato"><span>Docentes:</span> <span class="valor"><?php echo e($fisiatriaDocente); ?></span></div>
        <div class="dato"><span>Administrativos:</span> <span class="valor"><?php echo e($fisiatriaAdministrativo); ?></span></div>
        <div class="dato"><span>Estudiantes:</span> <span class="valor"><?php echo e($fisiatriaEstudiante); ?></span></div>
        <div class="dato"><span>Visitantes:</span> <span class="valor"><?php echo e($totalVisitantesFisiatria); ?></span></div>
    </div>

    <div class="cuadro-estadistica">
        <h3>Traumatología</h3>
        <div class="dato"><span>Total Consultas:</span> <span class="valor"><?php echo e($totalTraumatologia); ?></span></div>
        <div class="dato"><span>Obreros:</span> <span class="valor"><?php echo e($traumatologiaObrero); ?></span></div>
        <div class="dato"><span>Docentes:</span> <span class="valor"><?php echo e($traumatologiaDocente); ?></span></div>
        <div class="dato"><span>Administrativos:</span> <span class="valor"><?php echo e($traumatologiaAdministrativo); ?></span></div>
        <div class="dato"><span>Estudiantes:</span> <span class="valor"><?php echo e($traumatologiaEstudiante); ?></span></div>
        <div class="dato"><span>Visitantes:</span> <span class="valor"><?php echo e($totalVisitantesTraumatologia); ?></span></div>
    </div>

    <div class="cuadro-estadistica" style="background-color: #e3f2fd; border-color: #276fc2;">
        <h3>Resumen Global</h3>
        <div class="dato"><span>Total Visitantes (Todos):</span> <span class="valor"><?php echo e($totalVisitantes); ?></span></div>
        <div class="dato" style="font-size: 1.3em; margin-top: 15px;">
            <span>TOTAL CONSULTAS:</span> 
            <span class="valor"><?php echo e($totalConsultas); ?></span>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Unetrans\resources\views/estadisticas.blade.php ENDPATH**/ ?>