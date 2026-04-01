

<?php $__env->startSection('content'); ?>
<div class="dashboard">

 

  <main class="main-content" id="viewsMedico">

    <!-- ===== INICIO ===== -->
  <section id="view-inicio" class="view">

    <h1 class="hero__title-historial">Inactivar Usuarios</h1>

    <div class="container-search">
        <!--ESTA ES LA BARRA DE BUSQUEDA-->
        <span class="container-search__icon material-symbols-outlined">
          search
        </span>
        <form method="GET" action="<?php echo e(route('usuarios.inactivar')); ?>" class="form-buscar">
          <?php echo csrf_field(); ?>
        <input
          id="searchCedula"
          class="container-search__bar"
          type="text"
          name="buscar"
          placeholder="Ingresar Datos"
        />

        <button id="btnBuscarPaciente" class="container-search__btn">
          Buscar
        </button>
        </form>
    </div>
     <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!request('buscar')): ?>
      <div class="" id="mensajeBuscarPaciente">
        <span>Por favor, ingresar la cédula del paciente</span>
      </div>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <div style="display: flex; justify-content: center; width: 100%;">
    <div style="width: 100%; max-width: 900px;">
      
      <!--DE AQUI EN ADELANTE EL PERFIL-->
      <section id="view-perfil" class="view" style="display: flex; flex-direction: column; gap: 20px;">

       <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('buscar')): ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($noEsMedico): ?>
        <div class="alert-no-results">
            <span>El usuario encontrado no es un médico</span>
        </div>

    
    <?php elseif($resultados->isEmpty()): ?>
        <div class="alert-no-results">
            <span>No se encontraron médicos con este número de documento</span>
        </div>

    
    <?php else: ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $resultados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $persona): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
        <div class="perfil-container-card">
    <div class="profile-main-content">
        <div class="profile-sidebar">
            <div class="profile-avatar">
                <img src="<?php echo e($persona->foto ? asset('storage/' . $persona->foto) : asset('img/perfil.jpg')); ?>" alt="Foto">
            </div>
            <div class="profile-identidad">
                <h2 class="profile-full-name"><?php echo e($persona->nombre); ?> <?php echo e($persona->apellido); ?></h2>
                <span class="status-indicator">
                    Estado de Cuenta: 
                    <span class="estado-text <?php echo e($persona->estado ? 'status-active' : 'status-inactive'); ?>">
                        <?php echo e($persona->estado ? 'Activo' : 'Inactivo'); ?>

                    </span>
                </span>
            </div>
        </div>

        <div class="profile-details-wrapper">
            <div class="profile-info-grid">
                <div class="info-section">
                    <h3 class="section-title">DATOS PERSONALES</h3>
                    <div class="data-row"><span class="label">CÉDULA</span> <span class="value"><?php echo e($persona->tipo); ?>-<?php echo e($persona->cedula); ?></span></div>
                    <div class="data-row"><span class="label">ESTADO CIVIL</span> <span class="value"><?php echo e($persona->estado_civil); ?></span></div>
                    <div class="data-row"><span class="label">EDAD</span> <span class="value"><?php echo e(\Carbon\Carbon::parse($persona->fecha_nacimiento)->age); ?> años</span></div>
                    <div class="data-row"><span class="label">SEXO</span> <span class="value"><?php echo e($persona->sexo); ?></span></div>
                </div>

                <div class="info-section">
                    <h3 class="section-title">CONTACTO</h3>
                    <div class="data-row"><span class="label">TELÉFONO</span> <span class="value"><?php echo e($persona->codigo); ?>-<?php echo e($persona->telefono); ?></span></div>
                    <div class="data-row"><span class="label">CORREO</span> <span class="value text-lowercase"><?php echo e($persona->correo); ?></span></div>
                    <div class="data-row"><span class="label">DIRECCIÓN</span> <span class="value"><?php echo e($persona->direccion); ?></span></div>
                </div>
            </div>

            <hr class="divider">

            <div class="profile-footer-content">
                <div class="history-section">
                    <h3 class="section-title">Historial de Cuenta</h3>
                      <div class="data-row"><span class="label">REGISTRO</span> <span class="value">
                        <?php echo e(\Carbon\Carbon::parse($persona->created_at)->format('d/m/Y')); ?> </span>
                      </div>
                      <div class="data-row"><span class="label">ROL</span> <span class="value">
                        <?php echo e(ucfirst($persona->rol)); ?></span>
                      </div> 
                </div>

                <div class="actions-section">
                    <form method="POST" action="<?php echo e(route('usuarios.estado', $persona->cedula)); ?>" 
                    class="form-estado">
                        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                        <button type="submit" class="btn-estado <?php echo e($persona->estado ? 'btn-inactivar' : 'btn-activar'); ?>">
                            <span class="material-symbols-outlined">
                                <?php echo e($persona->estado ? 'power_settings_new' : 'check_circle'); ?>

                            </span>
                            <?php echo e($persona->estado ? 'Inactivar Usuario' : 'Activar Usuario'); ?>

                        </button>
                    </form>
                    <!--<a href="#" class="btn-revisar-link">
                        <i class="icon-search"></i> Revisar Historial
                    </a>-->
                </div>
            </div>
        </div>
    </div>
</div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    
    </section>
    </div>

    

    

    

    


  </main>
</div>
<script> window.csrfToken = "<?php echo e(csrf_token()); ?>"; </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/inactivar.js"></script>
<script src="js/profile.js" defer></script>
<script src="js/auth-overlay.js" defer></script>
<script src="js/app.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Unetrans\resources\views/inactivarUsuarios.blade.php ENDPATH**/ ?>