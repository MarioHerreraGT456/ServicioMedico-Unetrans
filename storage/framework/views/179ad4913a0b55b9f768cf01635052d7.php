<?php $__env->startSection('content'); ?>



  
  <div class="auth-page">
  <div class="auth-card">
    <aside class="auth-side">
      <h2>UNETRANS</h2>
      <p>Accede al sistema para gestionar tu perfil y los servicios del centro médico.</p>
    </aside>

    <section class="auth-main">
      <h1 class="auth-title">Iniciar sesión</h1>
      <p class="auth-sub">Ingresa con tu <b>cédula</b> y contraseña.</p>

      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
        <div class="auth-alert">
          <ul style="margin:0; padding-left:18px;">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
              <li><?php echo e($error); ?></li>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
          </ul>
        </div>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
    <div class="auth-alert" style="background-color: #d4edda; color: #155724; border-color: #c3e6cb;">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

      <form id="loginForm" class="auth-form" method="POST" action="<?php echo e(route('login')); ?>">
        <?php echo csrf_field(); ?>

        <div class="auth-field">
          <label for="cedula">Cédula</label>
          <input type="text" id="cedula" name="cedula" value="<?php echo e(old('cedula')); ?>"
                       title="Formato válido: V12345678, E12345678" placeholder="12345678" required>
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
        </div>

        <div class="auth-field" style="margin-top:14px;">
          <label for="password">Contraseña</label>
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

        <div class="auth-actions">
          <button class="auth-btn" type="submit">Iniciar sesión</button>


          
        </div>
      </form>
      <form method="POST" id="formCambiarClave">
    <?php echo csrf_field(); ?>
    
    
    <div class="auth-inline-links">
        <button type="submit" class="password-recovery">¿Olvidaste tu contraseña?</button>
    </div>
</form>
          <div class="auth-switch">
            <p>¿No tienes cuenta?</p>
            <a href="<?php echo e(route('register')); ?>">Registrarse</a>
          </div>
    </section>
  </div>
</div>
  <script>
    window.perfilUpdateClaveUrl = "<?php echo e(route('login.recoveryClave')); ?>";
    window.csrfToken = "<?php echo e(csrf_token()); ?>";
  </script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <script>
    (function() {
        const formRecuperar = document.getElementById('formCambiarClave');
        if (!formRecuperar) return;

        // Guardamos la URL base original (la que definió el backend)
        const originalUrl = window.perfilUpdateClaveUrl;

        formRecuperar.addEventListener('submit', function(e) {
            const inputCedula = document.getElementById('cedula');
            const cedula = inputCedula ? inputCedula.value.trim() : '';
            if (cedula) {
                // Añadimos la cédula como parámetro GET
                window.perfilUpdateClaveUrl = originalUrl + '?cedula=' + encodeURIComponent(cedula);
            }
            // No cancelamos el evento; el JS de correo.js lo hará después
        });
    })();
</script>


<script src="<?php echo e(asset('js/correo.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Unetrans\resources\views/login.blade.php ENDPATH**/ ?>