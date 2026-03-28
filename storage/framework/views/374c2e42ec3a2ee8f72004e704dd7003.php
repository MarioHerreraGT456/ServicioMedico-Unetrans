

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
            <span>No se encontraron médicos con ese criterio</span>
        </div>

    
    <?php else: ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $resultados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $persona): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <div class="profile-header-card-result">
                <div class="profile-photo-and-name-result">
                    <div class="profile-avatar-result">
                        <img src="<?php echo e($persona->foto ? asset('storage/' . $persona->foto) : asset('img/perfil.jpg')); ?>" alt="Foto" style="width:120px; height:120px; object-fit:cover; border-radius:50%;">
                    </div>
                    <div class="profile-main-info-result">
                        <h2 class="profile-name-result"><?php echo e($persona->nombre); ?> <?php echo e($persona->nombre2); ?></h2>
                        <h2 class="profile-name-result"><?php echo e($persona->apellido); ?> <?php echo e($persona->apellido2); ?></h2>
                    </div>
                </div>

                <div class="profile-dates-result">
                    <div class="profile-item">
                        <h3 class="profile-card-title">Datos personales</h3>
                        <div class="profile-grid">
                            <div class="profile-field">
                                <span class="label">Cédula</span>
                                <span class="value2"><?php echo e($persona->tipo); ?>-<?php echo e($persona->cedula); ?></span>
                            </div>

                            <div class="profile-field">
                                <span class="label">Estado Civil</span>
                                <span class="value2"><?php echo e($persona->estado_civil); ?></span>
                            </div>

                            <div class="profile-field">
                                <span class="label">Edad</span>
                                <span class="value2"><?php echo e(\Carbon\Carbon::parse($persona->fecha_nacimiento)->age); ?> años</span>
                            </div>

                            <div class="profile-field">
                                <span class="label">Sexo</span>
                                <span class="value2"><?php echo e($persona->sexo); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="profile-item">
                        <h3 class="profile-card-title">Contacto</h3>
                        <div class="profile-contact-list">
                            <div class="profile-contact-item2">
                                <div class="profile-field">
                                    <span class="label">Correo</span>
                                    <span class="value2"><?php echo e($persona->correo); ?></span>
                                </div>
                            </div>

                            <div class="profile-contact-item2">
                                <div class="profile-field">
                                    <span class="label">Telefono</span>
                                    <span class="value2"><?php echo e($persona->codigo); ?>-<?php echo e($persona->telefono); ?></span>
                                </div>
                            </div>

                            <div class="profile-contact-item2">
                                <div class="profile-field">
                                    <span class="label">Dirección</span>
                                    <span class="value2"><?php echo e($persona->direccion); ?></span>
                                </div>
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

<script src="js/profile.js" defer></script>
<script src="js/auth-overlay.js" defer></script>
<script src="js/app.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Unetrans\resources\views/inactivarUsuarios.blade.php ENDPATH**/ ?>