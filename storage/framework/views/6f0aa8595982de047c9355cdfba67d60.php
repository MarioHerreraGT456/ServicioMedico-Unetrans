<?php $__env->startSection('content'); ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <li>
                 
                    <?php echo e($error); ?></li>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </ul>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="auth-page">
    <div class="auth-card">
        <aside class="auth-side">
            <h2>UNETRANS</h2>
            <p>Completa tu registro creando una contraseña segura</p>
        </aside>

        <section class="auth-main">
            <h1 class="auth-title">Crear Contraseña</h1>
            <p class="auth-sub">Completa el siguiente formulario para completar tu registro.</p>                       
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                <div class="auth-alert">
                    <ul>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <li><?php echo e($error); ?></li>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </ul>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <form id="formRegistroPaciente" class="auth-form" method="POST" action="<?php echo e(route('password.register')); ?>" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      
        <div class="campo hidden">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo e($nombre); ?>" required>
        
        </div>
 <div class="campo hidden">
            <label for="nombre2">Segundo Nombre:</label>
            <input type="text" id="nombre2" name="nombre2" value="<?php echo e($nombre2); ?>" required>
        
        </div>

      <div class="campo hidden">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="<?php echo e($apellido); ?>" required>
           
        </div>
        <div class="campo hidden">
            <label for="apellido2">Segundo Apellido:</label>
            <input type="text" id="apellido2" name="apellido2" value="<?php echo e($apellido2); ?>" required>
           
        </div>
      
       
<div class="campo hidden">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($cedula2)): ?>
    <label for="cedula"></label>
    <label for="cedula2"></label>
    <div class="campoCedula">
        <input type="hidden" id="tipo" name="tipo" value="<?php echo e($tipo); ?>">
        <input type="hidden" name="cedula" value="<?php echo e($cedula); ?>">
        <input type="hidden" name="cedula2" value="<?php echo e($cedula2); ?>">
        
        <input type="hidden" name="tipo_personal" value="<?php echo e($tipo_personal ?? ''); ?>">
    </div>
    <?php else: ?>
    <label for="cedula">Cédula:</label>
    <div class="campoCedula">
        <input type="hidden" id="tipo" name="tipo" value="<?php echo e($tipo); ?>">
        <input type="hidden" name="cedula" value="<?php echo e($cedula); ?>">
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>


       <div class="campo hidden">
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="<?php echo e($direccion); ?>" required>
           
        </div>

        <div class="campo hidden">
            <label for="telefono">Teléfono:</label>
            <input type="hidden" id="codigo" name="codigo" value="<?php echo e($codigo); ?>">
            <input type="tel" id="telefono" name="telefono" value="<?php echo e($telefono); ?>"
                    required>
            
        </div>

     <div class="campo hidden">
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" value="<?php echo e($correo); ?>" required>
           
        </div>

        <div class="campo hidden">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo e($fecha_nacimiento); ?>" required>
          
        </div>
     
 
    

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($cargo)): ?>
        <div class="campo hidden">
            <label for="cargo">Cargo:</label>
            <input type="hidden" id="cargo" name="cargo" value="<?php echo e($cargo); ?>">
           
        </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($especialidad)): ?>
    <div class="campo hidden">
        <label for="especialidad">Especialidad:</label>
        <input type="text" id="especialidad" name="especialidad" value="<?php echo e($especialidad); ?>">
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      
       <div class="campo hidden">
            <label for="sexo">Sexo:</label>
            <input type="text" id="sexo" name="sexo" value="<?php echo e($sexo); ?>" required>  
        </div>

        
        <div class="campo hidden">
            <label for="selectEstadoCivil">Estado Civil:</label>
            <input type="text" id="estado_civil" name="estado_civil" value="<?php echo e($estado_civil); ?>" required>
            
            
        </div>
        <!--EL PROBLEMA ESTABA EN ESTE ISSET NO SE PORQUEEE-->
       <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($categoria)): ?>
        <div class="campo hidden">
            <input type="hidden" id="categoria" name="categoria" value="<?php echo e($categoria); ?>">
        </div>

        <div class="campo hidden">
            <input type="hidden" id="tipo_paciente" name="tipo_paciente" value="<?php echo e($tipo_paciente); ?>">
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($categoria == 'personal' && isset($tipo_personal)): ?>
        <div class="campo hidden">
            <input type="hidden" id="tipo_personal" name="tipo_personal" value="<?php echo e($tipo_personal); ?>">
        </div>
        <?php elseif($categoria == 'estudiante'): ?>
        <div class="campo hidden">
            <input type="hidden" id="tipo_personal" name="tipo_personal" value="">
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($categoria == 'estudiante' && isset($carrera)): ?>
        <div class="campo hidden">
            <input type="hidden" id="carrera" name="carrera" value="<?php echo e($carrera); ?>">
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <div class="campo"> 
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password'];
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

        <div class="campo">
            <label for="password_confirmation">Confirme contraseña:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password_confirmation'];
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

        <div class="hidden">
            <label for="rol" class="hidden">Rol:</label>
            <input type="hidden" name="rol" value="<?php echo e($rol); ?>">
        </div>
        
        
        <div class="campo">
            <button type="submit" id="btnRegistroContinuar">Confirmar</button>
        </div>
       </div>
       </section>
    </form>
    <script src="js/app.js" defer></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Unetrans\resources\views/password.blade.php ENDPATH**/ ?>