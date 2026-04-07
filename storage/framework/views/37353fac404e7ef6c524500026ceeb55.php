<header class="main-header">
  <nav class="main-header__nav-start">
    <div class="main-header__nav">

      <div class="main-header__menu desktop-only">
        <span class="main-header__icon-menu material-symbols-outlined">menu</span>
      </div>

      <div class="main-header__menu mobile-only">
        <span class="js-menu-trigger material-symbols-outlined" style="font-size: 35px; cursor: pointer;">menu</span>
      </div>

      <div class="main-header__logo">
        <img src="img/logo.jpg" alt="imagen de logo" class="main-header__img" onerror="this.style.display='none'"/>
      </div>

    </div>

    <ul class="main-header__list">
      <li class="main-header__item">
        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="button" class="main-header__link btn-logout" style="background: none; border: none; cursor: pointer;">
                Cerrar Sesión
            </button>
        </form>
      </li>
    </ul>
  </nav>
</header>

<aside id="sidebarMedico" class="sidebar">
  

  
 <div class="close">&times;</div>
  
  <div class="sidebar__header">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
    <?php
        $user = auth()->user();
        $foto = $user->foto;
    ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($foto): ?>
        <img src="<?php echo e(asset('storage/' . $foto)); ?>" 
            alt="Foto de Perfil"
            style="object-fit: cover;"
            onerror="this.style.display='none'">
    <?php else: ?>
        <img src="<?php echo e(asset('img/perfil.jpg')); ?>" 
            alt="Foto por defecto"
            style="object-fit: cover;">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <span class="sidebar__name"><?php echo e($user->nombre); ?> <?php echo e($user->apellido); ?></span>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
  </div>

  <nav class="sidebar__nav">

    <!-- SIEMPRE -->
    <a href="<?php echo e(route('medico.dashboard')); ?>" style="text-decoration: none;">
      <button class="sidebar__item" data-view="inicio">
        <span class="material-symbols-outlined">home</span>
        Inicio
      </button>
    </a>

    <a href="<?php echo e(route('perfil')); ?>" style="text-decoration: none;">
      <button class="sidebar__item" data-view="perfil">
        <span class="material-symbols-outlined">person</span>
        Perfil
      </button>
    </a>

    <?php
        $cargo = $user->medico->cargo ?? null;
    
    ?>
    <!-- MÉDICO NORMAL -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cargo !== 'jefe' && $cargo !== 'asistente' && !auth('admin')->check()): ?>
    <a href="<?php echo e(route('consultas')); ?>" style="text-decoration: none;">
        <button class="sidebar__item" data-view="solicitar">
            <span class="material-symbols-outlined">search</span>
            Consultas
        </button>
    </a>

    <a href="<?php echo e(route('historias')); ?>" style="text-decoration: none;">
        <button class="sidebar__item" data-view="solicitar">
            <span class="material-symbols-outlined">description</span>
            Historias
        </button>
    </a>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- ASISTENTE -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cargo === 'asistente'): ?>
    <a href="<?php echo e(route('crear-consultas')); ?>" style="text-decoration: none;">
        <button class="sidebar__item" data-view="solicitar">
            <span class="material-symbols-outlined">assignment_add</span>
            Crear Consultas
        </button>
    </a>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    
    <!-- MÉDICO NORMAL -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cargo !== 'jefe' && $cargo !== 'asistente' && !auth('admin')->check()): ?>
    <a href="<?php echo e(route('crear-historias')); ?>" style="text-decoration: none;">
        <button class="sidebar__item" data-view="solicitar">
            <span class="material-symbols-outlined">note_add</span>
            Crear Historias
        </button>
    </a>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- JEFE -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($user->rol === 'medico' && $user->medico && $user->medico->cargo === 'jefe') || auth('admin')->check()): ?>
        <a href="<?php echo e(route('registrar-medico')); ?>" style="text-decoration: none;">
            <button class="sidebar__item" data-view="solicitar">
                <span class="material-symbols-outlined">group_add</span>
                Crear Médicos
            </button>
        </a>

        <a href="<?php echo e(route('usuarios.inactivar')); ?>" style="text-decoration: none;">
            <button class="sidebar__item" data-view="solicitar">
                <span class="material-symbols-outlined">block</span>
                Inactivar Cuentas
            </button>
        </a>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="mobile-only" style="width: 100%; margin-top: 10px;">
        <form method="POST" action="<?php echo e(route('logout')); ?>" style="width: 100%;">
            <?php echo csrf_field(); ?>
            <button type="button" class="btn-logout"
                style="width: 100%; justify-content: flex-start; background: #ffebee; color: #c62828;">
                <span class="material-symbols-outlined">logout</span>
                Cerrar Sesión
            </button>
        </form>
    </div>

  </nav>
</aside>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo e(asset('js/cerrarSesion.js')); ?>"></script><?php /**PATH C:\xampp\htdocs\Unetrans\resources\views/components/headers/medico.blade.php ENDPATH**/ ?>