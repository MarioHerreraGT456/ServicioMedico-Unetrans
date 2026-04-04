<?php $__env->startSection('content'); ?>
<div class="dashboard">

 

  <main class="main-content" id="viewsMedico">

    <!-- ===== INICIO ===== -->
  <section id="view-inicio" class="view">
      <h1 class="hero__title">Bienvenido al Servicio Médico</h1>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($medico) && $medico->cargo !== 'asistente'): ?>
    <div class="container-search">
        <!--ESTA ES LA BARRA DE BUSQUEDA-->
        <span class="container-search__icon material-symbols-outlined">
          search
        </span>
        <form method="GET" action="<?php echo e(route('medico.dashboard')); ?>" class="form-buscar">
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
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <div class="contenedor-principal">
    <div class="columna-setenta">
      <!--<p>Esta es la columna del 70%.</p>-->
      
      <!--MENSAJE PARA CUANDO NO HAY NADA EN EL BUSCADOR-->
      <!--<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!request('buscar')): ?>
      <section id="view-perfil" class="view" style="display: flex; flex-direction: column; gap: 20px;">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard('admin')->check()): ?>
        <div class="profile-header-card-result" style="border-left: 5px solid #ffc107;">
            <div class="profile-photo-and-name-result">
                <div class="profile-avatar-result">
                    <img src="<?php echo e(asset('img/perfil.jpg')); ?>" alt="Foto Admin" style="width:120px; height:120px; border-radius:50%;">
                </div>
                <div class="profile-main-info-result">
                    <h2 class="profile-name-result"><?php echo e(Auth::guard('admin')->user()->usuario); ?></h2>
                    <span class="badge-admin" style="color: #856404; background-color: #fff3cd; padding: 5px 10px; border-radius: 5px; font-weight: bold;">
                        Jefe Médico
                    </span>
                </div>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($medico) && $medico->especialidad === 'general'): ?>
        <div class="info-medica-card general">
            <h3>Medicina General</h3>
            <p>
              La medicina general es la puerta de entrada al sistema de salud, orientada a la atención integral del paciente en todas las etapas de la vida. Se enfoca en la prevención, diagnóstico y tratamiento de enfermedades comunes, así como en la promoción de hábitos saludables. El médico general evalúa de forma global el estado físico del paciente, identifica factores de riesgo y, de ser necesario, refiere a otras especialidades. Su objetivo principal es brindar una atención continua, accesible y centrada en el bienestar general del individuo.
            </p>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($medico) && $medico->especialidad === 'odontologia'): ?>
        <div class="info-medica-card odontologia">
            <h3>Odontología</h3>
            <p>
                La odontología es la especialidad encargada del cuidado de la salud bucal, incluyendo dientes, encías y estructuras asociadas. Se enfoca en la prevención, diagnóstico y tratamiento de afecciones como caries, enfermedades periodontales y problemas de oclusión. Además, promueve hábitos de higiene oral adecuados para evitar complicaciones a largo plazo. Una buena salud bucal no solo mejora la estética, sino que también contribuye al bienestar general del organismo.
            </p>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($medico) && $medico->especialidad === 'psiquiatria'): ?>
        <div class="info-medica-card psiquiatria">
            <h3>Psiquiatría</h3>
            <p>
                La psiquiatría es la rama de la medicina dedicada al estudio, diagnóstico y tratamiento de los trastornos mentales, emocionales y del comportamiento. Su enfoque incluye la evaluación integral del paciente, considerando factores biológicos, psicológicos y sociales. A través de diferentes herramientas terapéuticas, busca mejorar la calidad de vida, el funcionamiento diario y el bienestar emocional del individuo, promoviendo una salud mental equilibrada.
            </p>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($medico) && $medico->especialidad === 'fisiatria'): ?>
        <div class="info-medica-card fisiatria">
            <h3>Fisiatría</h3>
            <p>
                La fisiatría, también conocida como medicina física y rehabilitación, se centra en la recuperación funcional de pacientes con limitaciones físicas o discapacidades. Su objetivo es mejorar la movilidad, reducir el dolor y optimizar la independencia del paciente mediante programas de rehabilitación personalizados. Trabaja en conjunto con terapias físicas y ocupacionales para lograr una reintegración efectiva a las actividades diarias.
            </p>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($medico) && $medico->especialidad === 'traumatologia'): ?>
        <div class="info-medica-card traumatologia">
            <h3>Traumatología</h3>
            <p>
                La fisiatría, también conocida como medicina física y rehabilitación, se centra en la recuperación funcional de pacientes con limitaciones físicas o discapacidades. Su objetivo es mejorar la movilidad, reducir el dolor y optimizar la independencia del paciente mediante programas de rehabilitación personalizados. Trabaja en conjunto con terapias físicas y ocupacionales para lograr una reintegración efectiva a las actividades diarias.
            </p>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </section>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>-->
      
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($medico) && $medico->cargo === 'asistente'): ?>

    
        <section id="view-lista" class="view" style="display: flex; flex-direction: column; gap: 20px;">
        <h1 class="hero__title">Orden de llegada</h1>

        <div class="waiting-header">
            <span class="material-symbols-outlined">notifications</span>
            <span id="contador-espera">
                <?php echo e($consultasPendientes->count()); ?>

            </span> pacientes en espera
        </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $consultasPendientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $consulta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>

                <div class="waiting-card" id="consulta-<?php echo e($consulta->id); ?>">

                    <div class="waiting-left">

                        <div class="waiting-avatar">
                            <img src="<?php echo e(asset('img/perfil.jpg')); ?>" alt="foto">
                        </div>

                        <div class="waiting-info">

                            <div class="waiting-row-top">

                                <span class="waiting-cedula">
                                    <?php echo e($consulta->tipo); ?>-<?php echo e($consulta->cedula); ?>

                                </span>

                                <span class="waiting-divider">|</span>

                                <span class="waiting-nombre">
                                    <?php echo e($consulta->nombre); ?> <?php echo e($consulta->nombre2); ?> 
                                    <?php echo e($consulta->apellido); ?> <?php echo e($consulta->apellido2); ?>

                                </span>

                            </div>

                            <div class="waiting-row-bottom">
                                <span class="waiting-hora">
                                    Llegada: <?php echo e(\Carbon\Carbon::parse($consulta->created_at)->format('h:i A')); ?>

                                </span>

                                <span class="waiting-badge">
                                    En espera
                                </span>
                            </div>

                        </div>

                    </div>

                    <button 
                        class="btn-atender-outline"
                        onclick="atenderConsulta(<?php echo e($consulta->id); ?>)">

                        <span class="material-symbols-outlined">check_circle</span>
                        Atender

                    </button>

                </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

    </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

      <!--DE AQUI EN ADELANTE EL PERFIL-->
      <section id="view-perfil" class="view" style="display: flex; flex-direction: column; gap: 20px;">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $resultados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $persona): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <?php
                // Buscamos si la persona actual es un FAMILIAR (está en la columna 'cedula' de la tabla personal)
                $relacion = \App\Models\Familiar::where('cedula2', $persona->cedula)->first();
            ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($relacion): ?>
                
                
                <div class="profile-header-card-result" style="border-left: 5px solid #276fc2;">
                    <div class="profile-photo-and-name-result">
                        <div class="profile-avatar-result">
                            <img src="<?php echo e($persona->foto ? asset('storage/' . $persona->foto) : asset('img/perfil.jpg')); ?>" alt="Foto" style="width:120px; height:120px; object-fit:cover; border-radius:50%;">
                        </div>
                        <div class="profile-main-info-result">
                            <h2 class="profile-name-result"><?php echo e($persona->nombre); ?> <?php echo e($persona->apellido); ?></h2>
                            <span class="badge-familiar" style="color: #007bff; font-weight: bold;">(Familiar Beneficiario)</span>
                        </div>
                    </div>

                    <div class="profile-dates-result">
                        <div class="profile-item">
                            <h3 class="profile-card-title">Datos Familiar</h3>
                            <div class="profile-grid">
                                <div class="profile-field">
                                    <span class="label">Cédula</span>
                                    <span class="value2"><?php echo e($persona->tipo); ?>-<?php echo e($persona->cedula); ?></span>
                                </div>
                                <div class="profile-field">
                                    <span class="label">Parentesco</span>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($relacion->tipo_personal === 'familiar'): ?>
                                        <span class="value2" style="color: #d9534f; font-weight: bold;">Padre/Madre</span>
                                    <?php else: ?>
                                    <span class="value2" style="color: #d9534f; font-weight: bold;"><?php echo e(strtoupper($relacion->tipo_personal)); ?></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div class="profile-field">
                                    <span class="label">Cédula Titular</span>
                                    <span class="value2"><?php echo e($relacion->cedula); ?></span>
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

                <?php
                    $titular = \App\Models\Persona::where('cedula', $relacion->cedula)->first();
                ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($titular): ?>
                    <div class="profile-header-card-result" style="border-left: 5px solid #28a745;">
                        <div class="profile-photo-and-name-result">
                            <div class="profile-avatar-result">
                                <img src="<?php echo e($titular->foto ? asset('storage/' . $titular->foto) : asset('img/perfil.jpg')); ?>" alt="Foto" style="width:100px; height:100px; object-fit:cover; border-radius:50%;">
                            </div>
                            <div class="profile-main-info-result">
                                <h2 class="profile-name-result"><?php echo e($titular->nombre); ?> <?php echo e($titular->apellido); ?></h2>
                                <span class="badge-titular" style="color: #28a745; font-weight: bold;">(Titular Responsable)</span>
                            </div>
                        </div>
                        <div class="profile-dates-result">
                            <div class="profile-item">
                                <h3 class="profile-card-title">Datos del Titular</h3>
                                <div class="profile-grid">
                                    <div class="profile-field">
                                        <span class="label">Cédula</span>
                                        <span class="value2"><?php echo e($titular->tipo); ?>-<?php echo e($titular->cedula); ?></span>
                                    </div>
                                   
                                    <div class="profile-field">
                                        <span class="label">Estado Civil</span>
                                        <span class="value2"><?php echo e($titular->estado_civil); ?></span>  
                                    </div>

                                    <div class="profile-field">
                                        <span class="label">Edad</span>
                                        <span class="value2"><?php echo e(\Carbon\Carbon::parse($titular->fecha_nacimiento)->age); ?> años</span>  
                                    </div>

                                    <div class="profile-field">
                                        <span class="label">Sexo</span>
                                        <span class="value2"><?php echo e($titular->sexo); ?></span>  
                                    </div>
                                </div>
                            </div>
                            <div class="profile-item">
                            <h3 class="profile-card-title">Contacto</h3>
                            <div class="profile-contact-list">
                                <div class="profile-contact-item2">
                                    <div class="profile-field">
                                        <span class="label">Correo</span>
                                        <span class="value2"><?php echo e($titular->correo); ?></span>
                                    </div> 
                                </div>
                                <div class="profile-contact-item2">
                                    <div class="profile-field">
                                        <span class="label">Telefono</span>
                                        <span class="value2"><?php echo e($titular->codigo); ?>-<?php echo e($persona->telefono); ?></span>
                                    </div> 
                                </div>
                                <div class="profile-contact-item2">
                                    <div class="profile-field">
                                        <span class="label">Dirección</span>
                                        <span class="value2"><?php echo e($titular->direccion); ?></span>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php else: ?>
                
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
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    
    </section>
    </div>

    <div class="columna-treinta">
       <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard('admin')->check()): ?>
        <section class="container-services__admin">
        <div class="container-services__img">
          <img src="img/jefemedico.jpg"
               alt="Jefe Médico"
               class="container-services__img-admin"
               onerror="this.style.display='none'"/>
        </div>
      </section>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($medico) && $medico->cargo === 'asistente'): ?>
            <section class="container-services__asistente">
                <div class="container-services__img">
                    <img src="img/asistente.jpg"
                        alt="Asistente"
                        class="container-services__img-asistente"
                        onerror="this.style.display='none'"/>
                </div>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($medico) &&
        $medico->especialidad === 'general' 
      ): ?>
        <section class="container-services__general-medicine">
        <div class="container-services__img">
          <img src="img/medicina_general.jpg"
               alt="medicina general"
               class="container-services__img-general-medicine"
               onerror="this.style.display='none'"/>
        </div>
      </section>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
  <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($medico) && $medico->especialidad === 'odontologia'): ?>
      <section class="container-services__dentistry">
        <div class="container-services__img">
          <img src="img/odontologia.jpg"
               alt="odontología"
               class="container-services_img-dentistry"
               onerror="this.style.display='none'"/>
        </div>
      </section>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($medico) && $medico->especialidad === 'psiquiatria'): ?>
        <section class="container-services__psychiatry">
        <div class="container-services__img">
          <img src="img/psquitria.jpg"
               alt="psiquiatría"
               class="container-services_img-psychiatry"
               onerror="this.style.display='none'"/>
        </div>
      </section>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($medico) && $medico->especialidad === 'traumatologia'): ?>
      <section class="container-services__traumatology">
        <div class="container-services__img">
          <img src="img/traumatologia.jpg"
               alt="traumatología"
               class="container-services_img-traumatology"
               onerror="this.style.display='none'"/>
        </div>
      </section>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($medico) && $medico->especialidad === 'fisiatria'): ?>
      <section class="container-services__physiatry">
        <div class="container-services__img">
          <img src="img/fisiatria.jpg"
               alt="fisiatría"
               class="container-services_img-physiatry"
               onerror="this.style.display='none'"/>
        </div>
      </section>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>

   

   

  </main>
</div>

<script src="js/profile.js" defer></script>
<script src="js/auth-overlay.js" defer></script>
<script src="js/app.js"></script>
<script>
    window.baseUrl = "<?php echo e(url('/')); ?>";
</script>
<script src="js/atenderConsultas.js" defer></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Unetrans\resources\views/medico.blade.php ENDPATH**/ ?>