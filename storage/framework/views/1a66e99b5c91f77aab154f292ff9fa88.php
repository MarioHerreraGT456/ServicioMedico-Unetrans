<?php $__env->startSection('content'); ?>
    <h2 class="title-form">Registrar Familiar</h2>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <li><?php echo e($error); ?></li>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </ul>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                            
                        <?php
                        $perfil = Auth::user()->perfil();
                        $cedula_titular = Auth::user()->cedula;
                      
                    ?>

    <div class="histories-wrapper">
        <div id="selector-tipo-familiar" class="auth-box selector-modal">
            <h2 class="title-form">¿A quién desea registrar?</h2>
            <p style="text-align: center; margin-bottom: 20px; color: #666;">Seleccione una opción para continuar</p>
            
            <div class="selector-options">
                <button type="button" class="btn-selector" data-target="form-nino">
                    <span class="material-symbols-outlined">child_care</span>
                    Niño (Menor de 10 años)
                </button>
                <button type="button" class="btn-selector" data-target="form-tercera">
                    <span class="material-symbols-outlined">elderly</span>
                    Tercera Edad
                </button>
                <button type="button" class="btn-selector" data-target="form-ninguno">
                    <span class="material-symbols-outlined">person</span>
                    Ninguno (Adulto convencional)
                </button>
            </div>
        </div>
        
        <div id="form-ninguno" class="view hidden">
          
            <form id="formRegistroPersonal" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
        
                 <div class="campo">
            <label for="nombre">Primer Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo e(old('nombre')); ?>" required>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['nombre'];
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
            <label for="nombre2">Segundo Nombre:</label>
            <input type="text" id="nombre2" name="nombre2" value="<?php echo e(old('nombre2')); ?>" required>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['nombre'];
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
            <label for="apellido">Primer Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="<?php echo e(old('apellido')); ?>" required>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['apellido'];
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
            <label for="apellido2">Segundo Apellido:</label>
            <input type="text" id="apellido2" name="apellido2" value="<?php echo e(old('apellido2')); ?>" required>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['apellido'];
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
                    <label for="cedula2">Cédula del familiar:</label>
                    <div id="campoCedula">
                        <label for="tipo" class="hidden">Tipo:</label>
                        <select name="tipo" id="tipo">
                            <option value="V" <?php echo e(old('tipo') == 'V' ? 'selected' : ''); ?>>V</option>
                            <option value="E" <?php echo e(old('tipo') == 'E' ? 'selected' : ''); ?>>E</option>
                        </select>
                        
                        <input type="text" id="cedula" name="cedula" value="<?php echo e($cedula_titular); ?>"
                               title="Formato válido: V12345678, E12345678" placeholder="12345678" class="hidden" required>
                             
                        <input type="text" id="cedula2" name="cedula2" value="<?php echo e(old('cedula2')); ?>"
                               title="Formato válido: V12345678, E12345678" placeholder="12345678" required>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['cedula'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error-message">Dato inválido</span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['tipo'];
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
                    <label for="direccion">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" value="<?php echo e(old('direccion')); ?>" required>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['direccion'];
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
            <label for="telefono">Teléfono:</label>
              <div id="campoCedula">
                <label for="codigo" class="hidden">Codigo:</label>
                <select name="codigo" id="codigo">
                    <option value="0414">0414</option>
                    <option value="0424">0424</option>
                    <option value="0412">0412</option>
                    <option value="0416">0416</option>
                    <option value="0426">0426</option>
                </select>
             <input type="tel" id="telefono" name="telefono" value="<?php echo e(old('telefono')); ?>"
                   placeholder="1234567"
                   
                    required>
                 </div>
                   <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['telefono'];
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
                    <label for="correo">Correo:</label>
                    <input type="email" id="correo" name="correo" value="<?php echo e(old('correo')); ?>" required>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['correo'];
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
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo e(old('fecha_nacimiento')); ?>" required>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['fecha_nacimiento'];
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
               
                <!-- SEXO -->
                <div class="campo">
                    <label for="selectSexo">Sexo:</label>
                    <select id="selectSexo" name="sexo" required>
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
        
                <!-- ESTADO CIVIL -->
                <div class="campo">
                    <label for="selectEstadoCivil">Estado Civil:</label>
                    <select id="selectEstadoCivil" name="estado_civil" required>
                        <option value="Soltero(a)" <?php echo e(old('estado_civil') == 'Soltero(a)' ? 'selected' : ''); ?>>Soltero(a)</option>
                        <option value="Casado(a)" <?php echo e(old('estado_civil') == 'Casado(a)' ? 'selected' : ''); ?>>Casado(a)</option>
                        <option value="Divorciado(a)" <?php echo e(old('estado_civil') == 'Divorciado(a)' ? 'selected' : ''); ?>>Divorciado(a)</option>
                        <option value="Viudo(a)" <?php echo e(old('estado_civil') == 'Viudo(a)' ? 'selected' : ''); ?>>Viudo(a)</option>
                    </select>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['estado_civil'];
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
              <div class="campo hidden">
                    <label for="tipo_paciente">Tipo de Personal:</label>
                    <input type="hidden" name="tipo_paciente" value="administrativo">
                     <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['tipo_paciente'];
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
            <label for="tipo_personal">Tipo de Parentesco:</label>
            <select name="tipo_personal" id="tipo_personal">
                <option value="hijo" <?php echo e(old('tipo_personal') == 'hijo' ? 'selected' : ''); ?>>Hijo(a)</option>
                <option value="casado" <?php echo e(old('tipo_personal') == 'casado' ? 'selected' : ''); ?>>Esposo(a)</option>
                <option value="hermano" <?php echo e(old('tipo_personal') == 'hermano' ? 'selected' : ''); ?>>Hermano(a)</option>
                <option value="familiar" <?php echo e(old('tipo_personal') == 'familiar' ? 'selected' : ''); ?>>Padre o Madre</option>
                <option value="tio" <?php echo e(old('tipo_personal') == 'tio' ? 'selected' : ''); ?>>Tío(a)</option>
                <option value="sobrino" <?php echo e(old('tipo_personal') == 'sobrino' ? 'selected' : ''); ?>>Sobrino(a)</option>
                <option value="primo" <?php echo e(old('tipo_personal') == 'primo' ? 'selected' : ''); ?>>Primo(a)</option>
            </select>
        </div>
        
                <div class="campo hidden">
                    <label for="categoria">Tipo de Paciente:</label>
                    <input type="hidden" name="categoria" value="personal">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['categoria'];
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
                    <input type="hidden" name="rol" value="paciente">
                </div>
              
                <div class="campo">
                    <button type="submit" id="btnRegistroContinuar">Registrar</button>
                </div>
            </form>
              <button type="button" class="btn-regresar" title="Volver al selector">
        <span class="material-symbols-outlined">arrow_back</span>
    </button>

        </div>

        <div id="form-tercera" class="view hidden">
            
            <h2 class="title-form">Registrar Persona Tercera Edad</h2>
             <form id="formRegistroPersonal" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
        
                <div class="campo">
            <label for="nombre">Primer Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo e(old('nombre')); ?>" required>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['nombre'];
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
            <label for="nombre2">Segundo Nombre:</label>
            <input type="text" id="nombre2" name="nombre2" value="<?php echo e(old('nombre2')); ?>" required>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['nombre'];
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
            <label for="apellido">Primer Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="<?php echo e(old('apellido')); ?>" required>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['apellido'];
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
            <label for="apellido2">Segundo Apellido:</label>
            <input type="text" id="apellido2" name="apellido2" value="<?php echo e(old('apellido2')); ?>" required>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['apellido'];
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
                    <label for="cedula2">Cédula del familiar:</label>
                    <div id="campoCedula">
                        <label for="tipo" class="hidden">Tipo:</label>
                        <select name="tipo" id="tipo">
                            <option value="V" <?php echo e(old('tipo') == 'V' ? 'selected' : ''); ?>>V</option>
                            <option value="E" <?php echo e(old('tipo') == 'E' ? 'selected' : ''); ?>>E</option>
                        </select>
                        
                        <input type="hidden" id="cedula" name="cedula" value="<?php echo e($cedula_titular); ?>"
                               title="Formato válido: V12345678, E12345678" placeholder="12345678" class="hidden" required>
                             
                        <input type="text" id="cedula2" name="cedula2" value="<?php echo e(old('cedula2')); ?>"
                               title="Formato válido: V12345678, E12345678" placeholder="12345678" required>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['cedula'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error-message">Dato inválido</span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['tipo'];
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
                    <label for="direccion">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" value="<?php echo e(old('direccion')); ?>" required>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['direccion'];
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
            <label for="telefono">Teléfono:</label>
              <div id="campoCedula">
                <label for="codigo" class="hidden">Codigo:</label>
                <select name="codigo" id="codigo">
                    <option value="0414">0414</option>
                    <option value="0424">0424</option>
                    <option value="0412">0412</option>
                    <option value="0416">0416</option>
                    <option value="0426">0426</option>
                </select>
            <input type="tel" id="telefono" name="telefono" value="<?php echo e(old('telefono')); ?>"
                   placeholder="1234567"
                   
                    required>
                 </div>
                   <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['telefono'];
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
                    <label for="correo">Correo:</label>
                    <input type="email" id="correo" name="correo" value="<?php echo e(old('correo')); ?>" required>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['correo'];
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
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo e(old('fecha_nacimiento')); ?>" required>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['fecha_nacimiento'];
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
               
        
                <!-- SEXO -->
                <div class="campo">
                    <label for="selectSexo">Sexo:</label>
                    <select id="selectSexo" name="sexo" required>
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
        
                <!-- ESTADO CIVIL -->
                <div class="campo">
                    <label for="selectEstadoCivil">Estado Civil:</label>
                    <select id="selectEstadoCivil" name="estado_civil" required>
                        <option value="Soltero(a)" <?php echo e(old('estado_civil') == 'Soltero(a)' ? 'selected' : ''); ?>>Soltero(a)</option>
                        <option value="Casado(a)" <?php echo e(old('estado_civil') == 'Casado(a)' ? 'selected' : ''); ?>>Casado(a)</option>
                        <option value="Divorciado(a)" <?php echo e(old('estado_civil') == 'Divorciado(a)' ? 'selected' : ''); ?>>Divorciado(a)</option>
                        <option value="Viudo(a)" <?php echo e(old('estado_civil') == 'Viudo(a)' ? 'selected' : ''); ?>>Viudo(a)</option>
                    </select>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['estado_civil'];
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
              <div class="campo hidden">
                    <label for="tipo_paciente">Tipo de Personal:</label>
                    <input type="hidden" name="tipo_paciente" value="administrativo">
                </div>

                <div class="campo">
            <label for="tipo_personal">Tipo de Parentesco:</label>
            <select name="tipo_personal" id="tipo_personal">
    
                <option value="familiar" <?php echo e(old('tipo_personal') == 'familiar' ? 'selected' : ''); ?>>Padre o Madre</option>
                <option value="tio" <?php echo e(old('tipo_personal') == 'tio' ? 'selected' : ''); ?>>Tío(a)</option>
                <option value="sobrino" <?php echo e(old('tipo_personal') == 'sobrino' ? 'selected' : ''); ?>>Sobrino(a)</option>

            </select>
        </div>
        
                <div class="campo hidden">
                    <label for="categoria">Tipo de Paciente:</label>
                    <input type="hidden" name="categoria" value="personal">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['categoria'];
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
                    <input type="hidden" name="rol" value="paciente">
                </div>
              
                <div class="campo">
                    <button type="submit" id="btnRegistroContinuar">Registrar</button>
                </div>
            </form>
            <button type="button" class="btn-regresar" title="Volver al selector">
        <span class="material-symbols-outlined">arrow_back</span>
    </button>
        </div>

        <div id="form-nino" class="view hidden">
           
            <h2 class="title-form">Registrar Niño (Sin Cédula)</h2>
            <form id="formRegistroPersonal" method="POST" action="<?php echo e(route('envio.correo')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="categoria_especial" value="nino">

                <div class="campo full-width">
                    <label for="numero_hijo">¿Qué número de hijo es? (Ej: 1, 2...):</label>
                    <input type="tell" id="numero_hijo" min="1" 
           data-cedula-padre="<?php echo e($cedula_titular ?? ''); ?>" 
           
           placeholder="Ingrese el número de hijo" required>
                </div>

                 <div class="campo">
            <label for="nombre">Primer Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo e(old('nombre')); ?>" required>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['nombre'];
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
            <label for="nombre2">Segundo Nombre:</label>
            <input type="text" id="nombre2" name="nombre2" value="<?php echo e(old('nombre2')); ?>" required>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['nombre'];
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
            <label for="apellido">Primer Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="<?php echo e(old('apellido')); ?>" required>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['apellido'];
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
            <label for="apellido2">Segundo Apellido:</label>
            <input type="text" id="apellido2" name="apellido2" value="<?php echo e(old('apellido2')); ?>" required>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['apellido'];
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
                    <label for="cedula2">Cédula Generada:</label>
                    <div id="campoCedula">
                        <select name="tipo" class="hidden"><option value="V" selected>V</option></select>
                        <input type="text" name="cedula" value="<?php echo e($cedula_titular); ?>" class="hidden">
                        
                        <input type="text" id="cedula2_nino" name="cedula2" 
                               readonly tabindex="-1" 
                               style="background-color: #f3f4f6; pointer-events: none; color: #6b7280; font-weight: bold;" 
                               placeholder="Se generará automáticamente"  required>
                    </div>
                </div>

                <div class="campo">
                    <label for="direccion">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" required>
                </div>

               <div class="campo">
            <label for="telefono">Teléfono:</label>
              <div id="campoCedula">
                <label for="codigo" class="hidden">Codigo:</label>
                <select name="codigo" id="codigo">
                    <option value="0414">0414</option>
                    <option value="0424">0424</option>
                    <option value="0412">0412</option>
                    <option value="0416">0416</option>
                    <option value="0426">0426</option>
                </select>
            <input type="tel" id="telefono" name="telefono" value="<?php echo e(old('telefono')); ?>"
                   placeholder="1234567"
                   
                    required>
                 </div>
                   <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['telefono'];
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
                    <label for="correo">Correo:</label>
                    <input type="email" id="correo" name="correo" required>
                </div>

                <div class="campo">
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" id="fecha_nacimiento1" name="fecha_nacimiento" required>
                </div>

            

                <div class="campo">
                    <label for="selectSexo">Sexo:</label>
                    <select id="selectSexo" name="sexo" required>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                    </select>
                </div>

                 <div class="campo hidden">
                    <label for="selectEstadoCivil">Estado Civil:</label>
                    <input type="hidden" id="selectEstadoCivil" name="estado_civil" value="Soltero(a)" required>
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['estado_civil'];
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

                <div class="campo hidden">
                    <label for="tipo_personal">Tipo de Parentesco:</label>
                    <input type="hidden" name="tipo_personal" value="hijo" class="hidden">
                    
                </div>
                <input type="hidden" name="tipo_paciente" value="administrativo">

                <input type="hidden" name="categoria" value="personal">
                <input type="hidden" name="rol" value="paciente">
              
                <div class="campo">
                    <button type="submit" id="btnRegistroContinuarNino" class="btn-principal">Registrar Niño</button>
                </div>
            </form>
             <button type="button" class="btn-regresar" title="Volver al selector">
        <span class="material-symbols-outlined">arrow_back</span>
    </button>
        </div>
          <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <script>
        window.envioCorreoUrl = "<?php echo e(route('register.submit')); ?>";
        window.csrfToken = "<?php echo e(csrf_token()); ?>";
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo e(asset('js/correoRegisterFamiliar.js')); ?>"></script>

    <script src="js/app.js" defer></script>
    <script src="js/selector-familiar.js" defer></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Unetrans\resources\views/agregar-familiar.blade.php ENDPATH**/ ?>