
<div class="historia-doc__encabezado">

    <form id="formRegistroConsulta" method="POST" action="<?php echo e(route('consultas.store')); ?>" enctype="multipart/form-data" style="width: 100%; display: flex; justify-content: center;">
    <?php echo csrf_field(); ?>
    <div class="historia-doc">

    <div class="historia-doc__cintillo">
        <img src="img/cintillo.jpeg" class="logo-left">
    </div>

    <div class="historia-doc__header">
        <h3 class="historia-doc__titulo-central">CONSULTA MÉDICA</h3>
    </div>

    <div class="historia-doc__body">
    <div class="historia-doc__row historia-doc__row--search">
        <div class="campo historia-doc__field historia-doc__field--tipo-busqueda">
            <label for="cedula">Cédula:</label>
            <div id="campoCedula" class="historia-doc__inline-group">
                <label for="tipo" class="hidden">Tipo:</label>
                <select name="tipo" id="tipo">
                    <option value="V">V</option>
                    <option value="E">E</option>
                </select>
                <input 
                    type="text" 
                    wire:model.live.debounce.500ms="buscar" 
                    class="container-search__bar"
                    placeholder="Escriba para buscar..."
                >
            </div>
        </div>
    </div>

    <div class="campo hidden">
        <label for="cedula">Cédula:</label>
        <input type="text" name="cedula" wire:model="cedula" required>
    </div>


    <div class="historia-doc__row historia-doc__row--two">

        <div class="campo historia-doc__field">
            <label for="nombre">Primer Nombre:</label>
            <input type="text" name="nombre" wire:model="nombre" required>
        </div>

        <div class="campo historia-doc__field">
            <label for="nombre2">Segundo Nombre:</label>
            <input type="text" name="nombre2" wire:model="nombre2">
        </div>

    </div>


    <div class="historia-doc__row historia-doc__row--two">

        <div class="campo historia-doc__field">
            <label for="apellido">Primer Apellido:</label>
            <input type="text" name="apellido" wire:model="apellido" required>
        </div>

        <div class="campo historia-doc__field">
            <label for="apellido2">Segundo Apellido:</label>
            <input type="text" name="apellido2" wire:model="apellido2" required>
        </div>

    </div>


    <div class="historia-doc__row historia-doc__row--two">

        <div class="campo historia-doc__field">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" wire:model="fecha_nacimiento" required>
        </div>

        <div class="campo historia-doc__field">
            <label for="fecha_consulta">Fecha de Consulta:</label>
            <input type="date" id="fecha_consulta" name="fecha_consulta" value="<?php echo e(now('America/Caracas')->toDateString()); ?>" required>
        </div>

    </div>


    <div class="historia-doc__row historia-doc__row--four">

        <div class="campo historia-doc__field">
            <label for="sexo">Sexo:</label>
             <select id="sexo" name="sexo" required>
                        <option value="masculino" <?php echo e(old('sexo') == 'masculino' ? 'selected' : ''); ?>>Masculino</option>
                        <option value="femenino" <?php echo e(old('sexo') == 'femenino' ? 'selected' : ''); ?>>Femenino</option>
                    </select>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['sexo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error-message">Dato inválido</span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="campo historia-doc__field">
            <label for="especialidad">Especialidad:</label>
            <select id="especialidad" name="especialidad" required>
                <option value="odontologia">Odontología</option>
                <option value="general">Medicina General</option>
                <option value="psiquiatria">Psiquiatría</option>    
                <option value="fisiatria">Fisiatria</option>  
                <option value="traumatologia">Traumatología</option>  
            </select>
        </div>

        <div class="campo historia-doc__field">
            <label for="TA">Tensión Arterial:</label>
            <input type="text" id="TA" name="TA" value="<?php echo e(old('TA')); ?>" required>
        </div>

    </div>


    <div class="historia-doc__row historia-doc__row--one">

        <div class="campo historia-doc__field historia-doc__field--full">
            <label for="motivo">Motivo de Consulta:</label>
            <div id="contenedor_tipo_consulta" style="display: none;">
    
    <input type="hidden" id="tipo_consulta" name="tipo_consulta">

    <div class="antecedentes-selector historia-doc__selector">
        <button type="button" class="btn-ant1" data-valor="niños">Control de niños sanos</button>
        <button type="button" class="btn-ant1" data-valor="parto">Consulta parto humanizado</button>
        <button type="button" class="btn-ant1" data-valor="pesquisa">Pesquisa de CA</button>
        <button type="button" class="btn-ant1" data-valor="vital">Apoyo Vital</button>
    </div>

</div>
            <input type="text" id="motivo" name="motivo" value="<?php echo e(old('motivo')); ?>" required>
        </div>

    </div>


    <div class="historia-doc__row historia-doc__row--one">

        <div class="campo historia-doc__field historia-doc__field--full">
            <label for="nombre_doctor">Nombre del Doctor:</label>
            <input type="text" id="nombre_doctor" name="nombre_doctor" value="<?php echo e(old('nombre_doctor')); ?>" required>
        </div>

    </div>


    <div class="historia-doc__row historia-doc__row--one">

        <div class="campo historia-doc__field historia-doc__field--full">
            <label for="tratamiento">Tratamiento:</label>
            <textarea id="tratamiento" name="tratamiento" required><?php echo e(old('tratamiento')); ?></textarea>
        </div>

    </div>
    <div>
        <label for="visitante">¿Es visitante?</label>
        
        <input type="hidden" name="visitante" value="no">
        
        <input type="checkbox" name="visitante" id="visitante" value="si">
    </div>


    <div class="historia-doc__actions">
        <button type="submit" id="btnRegistroContinuar">Registrar</button>
    </div>
</div>
    </form>      

</div>
<?php /**PATH C:\xampp\htdocs\Unetrans\resources\views/livewire/buscador-h-c.blade.php ENDPATH**/ ?>