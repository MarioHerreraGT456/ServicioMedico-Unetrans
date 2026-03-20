<?php $__env->startSection('content'); ?>

    <section id="view-perfil" class="view">

    <!-- ===== PERFIL HEADER ===== -->
    <div class="profile-header-card">

  <div class="profile-avatar">
      <form action="<?php echo e(route('perfil.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <img 
          src="<?php echo e($user->foto ? asset('storage/' . $user->foto) : asset('img/perfil.jpg')); ?>" 
          alt="Foto de perfil"
          style="width:120px; height:120px; object-fit:cover; border-radius:50%;"
        >

        <!-- Icono de edición -->
        <span 
          class="material-symbols-outlined foto-edit"
          style="cursor:pointer; position:absolute; margin-left:-30px; margin-top:90px;"
          onclick="document.getElementById('fotoInput').click()"
          title="Cambiar foto"
        >
          edit
        </span>

        <input 
          type="file" 
          name="foto" 
          id="fotoInput" 
          style="display:none;" 
          onchange="this.form.submit()"
          accept="image/*"
        >
      </form>
    </div>

    <div class="profile-main-info">
      <h2 class="profile-name"><?php echo e(ucfirst($user->nombre)); ?> <?php echo e(ucfirst($user->apellido)); ?></h2>
      <span class="profile-role"><?php echo e(ucfirst($user->rol)); ?></span>
    </div>

  </div>

    <!-- ===== DATOS PERSONALES ===== -->
    <div class="profile-card">
      <h3 class="profile-card-title">Datos personales</h3>

      <div class="profile-grid">
        <div class="profile-item">
          <span class="label">Cédula</span>
          <span class="value" id="perfilCedula"><?php echo e($user->tipo); ?>-<?php echo e($user->cedula); ?></span>
        </div>

        <div class="profile-item">
          <span class="label">Fecha de nacimiento</span>
          <span class="value" id="perfilFechaNacimiento">
            <?php echo e(\Carbon\Carbon::parse($user->fecha_nacimiento)->format('d/m/Y')); ?>

            
          </span>
        </div>

        <div class="profile-item">
          <span class="label">Edad</span>
          <span class="value" id="perfilEdad">
          <?php echo e(\Carbon\Carbon::parse($user->fecha_nacimiento)->age); ?> años
          </span>
        </div>

        <div class="profile-item">
          <span class="label">Sexo</span>
          <span class="value" id="perfilSexo"><?php echo e($user->sexo); ?></span>
        </div>

        <div class="profile-item">
          <span class="label">Estado civil</span>
          <span class="value" id="perfilEstadoCivil"><?php echo e($user->estado_civil); ?></span>
        </div>
      </div>
    </div>

    <!-- ===== CONTACTO ===== -->
    <div class="profile-card">
      <h3 class="profile-card-title">Contacto</h3>

      <div class="profile-contact-list">

        <div class="profile-contact-item">
          <span class="contact-label">Correo</span>
          
          <!--<div class="contact-value">
            <span id="perfilCorreo"><?php echo e($user->correo); ?></span>
            <span class="material-symbols-outlined contact-edit"
                  title="Próximamente editable">
              edit
            </span>
          </div>-->
          
          <div class="contact-value">
          <input type="text" 
            id="perfilCorreo"
            value="<?php echo e($user->correo); ?>"
            readonly
            class="input-contact">

            <!--aqui ya se puede editar-->
            <span class="material-symbols-outlined contact-edit"
            onclick="editarCampo('perfilCorreo')">
            edit
            </span>
            </div>
        </div>

        <div class="profile-contact-item">
          <span class="contact-label">Teléfono</span>
          <!--<div class="contact-value">
            <span id="perfilTelefono"><?php echo e($user->telefono); ?></span>
            <span class="material-symbols-outlined contact-edit"
                  title="Próximamente editable">
              edit
            </span>
          </div>-->
          <div class="contact-value">
          <input type="text" 
          id="perfilTelefono"
          value="<?php echo e($user->telefono); ?>"
          readonly
          class="input-contact">

          <span class="material-symbols-outlined contact-edit"
          onclick="editarCampo('perfilTelefono')">
          edit
          </span>
          </div>
        </div>

        <div class="profile-contact-item">
          <span class="contact-label">Dirección</span>
          <!--<div class="contact-value">
            <span id="perfilDireccion"><?php echo e($user->direccion); ?></span>
            <span class="material-symbols-outlined contact-edit"
                  title="Próximamente editable">
              edit
            </span>
          </div>-->

          <div class="contact-value">
            <input type="text" 
              id="perfilDireccion"
              value="<?php echo e($user->direccion); ?>"
              readonly
              class="input-contact">

              <span class="material-symbols-outlined contact-edit"
              onclick="editarCampo('perfilDireccion')">
              edit
              </span>
          </div>
        </div>
      </div>
    </div>

    <!-- ===== SISTEMA ===== -->
    <div class="profile-card">
      <h3 class="profile-card-title">Información del sistema</h3>

      <div class="profile-grid">
        <div class="profile-item">
          <span class="label">Rol</span>
          <span class="value" id="perfilRolSistema"><?php echo e(ucfirst($user->rol)); ?></span>
        </div>

        <div class="profile-item">
          <span class="label">Fecha de registro</span>
          <span class="value" id="perfilFechaRegistro">
            <?php echo e($user->created_at->format('d/m/Y')); ?>

          </span>
        </div>

       <!--<div class="profile-item">
          <span class="label">Estado de cuenta</span>
          <span class="value status-active" id="perfilEstadoCuenta"><?php echo e(ucfirst($user->estado)); ?></span>
        </div>-->
      </div>
    </div>
    
    <div class="profile-card">
  <h3 class="profile-card-title">Acciones del Sistema</h3>
  <form method="POST" id="formCambiarClave">
    <?php echo csrf_field(); ?>
    <div class="campo">
      <button type="submit" id="btnCambiarClave">Cambiar Contraseña</button>
    </div>
  </form>
</div>

  </section>

  <script>
    window.perfilUpdateUrl = "<?php echo e(route('perfil.updateContacto')); ?>";
    window.perfilUpdateClaveUrl = "<?php echo e(route('perfil.updateClave')); ?>";
    window.csrfToken = "<?php echo e(csrf_token()); ?>";
  </script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="<?php echo e(asset('js/perfil.js')); ?>"></script>
  <script src="<?php echo e(asset('js/correo.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Unetrans\resources\views/perfil.blade.php ENDPATH**/ ?>