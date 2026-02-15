@extends('layouts.app')

@section('content')
<!-- ================= MENU LATERAL MÉDICO ================= -->
<aside id="sidebarMedico" class="sidebar">

  <div class="sidebar__header">
    <img src="img/perfil.jpg" alt="Perfil">
    <span class="sidebar__name">Médico</span>
  </div>

  <nav class="sidebar__nav">

    <button class="sidebar__item active" data-view="inicio">
      <span class="material-symbols-outlined">home</span>
      Inicio
    </button>

    <button class="sidebar__item" data-view="perfil">
      <span class="material-symbols-outlined">person</span>
      Perfil
    </button>

    <button class="sidebar__item" data-view="consultas">
      <span class="material-symbols-outlined">search</span>
      Consultas
    </button>

    <button class="sidebar__item" data-view="historial">
      <span class="material-symbols-outlined">folder</span>
      Historial
    </button>

    <button class="sidebar__item" data-view="estadisticas">
      <span class="material-symbols-outlined">bar_chart</span>
      Estadísticas
    </button>

    <button id="btnAbrirCrearMedico" class="sidebar__item sidebar__item-action" type="button">
        <span class="material-symbols-outlined">person_add</span>
        Crear Médico
    </button>

    <button class="sidebar__item" data-view="solicitar">
      <span class="material-symbols-outlined">lock_open</span>
      Registrar Familiar
    </button>

    <button class="sidebar__item sidebar__item--cerrar" id="btnCerrarMenu">
      <span class="material-symbols-outlined">close</span>
      Cerrar Menú
    </button>

  </nav>

</aside>

<!-- ================= CONTENIDO ================= -->
<main class="main-content" id="viewsMedico">

  <!-- ===== INICIO ===== -->
  <section id="view-inicio" class="view">

    <div class="container-search">
      <span class="container-search__icon material-symbols-outlined">
        search
      </span>

      <input
        id="searchCedula"
        class="container-search__bar"
        type="text"
        placeholder="Buscar paciente por cédula"
      />

      <button id="btnBuscarPaciente" class="container-search__btn">
        Buscar
      </button>
    </div>

    <div class="container-welcome">
      <h1>Bienvenido al Servicio Médico</h1>
    </div>

    <div class="container-services">
      <section class="container-services__general-medicine">
        <div class="container-services__img">
          <img src="img/medicina_general.jpg"
               alt="Medicina General"
               class="container-services__img-general-medicine"
               onerror="this.style.display='none'"/>
        </div>
      </section>

      <section class="container-services__dentistry">
        <div class="container-services__img">
          <img src="img/odontologia.jpg"
               alt="Odontología"
               class="container-services_img-dentistry"
               onerror="this.style.display='none'"/>
        </div>
      </section>

      <section class="container-services__psychiatry">
        <div class="container-services__container-img">
          <img src="img/psquitria.jpg"
               alt="Psiquiatría"
               class="container-services_img-psychiatry"
               onerror="this.style.display='none'"/>
        </div>
      </section>
    </div>
  </section>

  <!-- ===== PERFIL ===== -->
  <section id="view-perfil" class="view hidden">

    <!-- ===== PERFIL HEADER ===== -->
    <div class="profile-header-card">
      <div class="profile-avatar">
        <img src="img/perfil.jpg" alt="Foto de perfil"
            onerror="this.style.display='none'">
      </div>

      <div class="profile-main-info">
        <h2 class="profile-name" id="perfilNombre"></h2>
        <span class="profile-role" id="perfilRol"></span>
        <span class="profile-status active" id="perfilEstado"></span>
      </div>
    </div>

    <!-- ===== DATOS PERSONALES ===== -->
    <div class="profile-card">
      <h3 class="profile-card-title">Datos personales</h3>

      <div class="profile-grid">
        <div class="profile-item">
          <span class="label">Cédula</span>
          <span class="value" id="perfilCedula"></span>
        </div>

        <div class="profile-item">
          <span class="label">Fecha de nacimiento</span>
          <span class="value" id="perfilFechaNacimiento"></span>
        </div>

        <div class="profile-item">
          <span class="label">Edad</span>
          <span class="value" id="perfilEdad"></span>
        </div>

        <div class="profile-item">
          <span class="label">Sexo</span>
          <span class="value" id="perfilSexo"></span>
        </div>

        <div class="profile-item">
          <span class="label">Estado civil</span>
          <span class="value" id="perfilEstadoCivil"></span>
        </div>
      </div>
    </div>

    <!-- ===== CONTACTO ===== -->
    <div class="profile-card">
      <h3 class="profile-card-title">Contacto</h3>

      <div class="profile-contact-list">

        <div class="profile-contact-item">
          <span class="contact-label">Correo</span>
          <div class="contact-value">
            <span id="perfilCorreo"></span>
            <span class="material-symbols-outlined contact-edit"
                  title="Próximamente editable">
              edit
            </span>
          </div>
        </div>

        <div class="profile-contact-item">
          <span class="contact-label">Teléfono</span>
          <div class="contact-value">
            <span id="perfilTelefono"></span>
            <span class="material-symbols-outlined contact-edit"
                  title="Próximamente editable">
              edit
            </span>
          </div>
        </div>

        <div class="profile-contact-item">
          <span class="contact-label">Dirección</span>
          <div class="contact-value">
            <span id="perfilDireccion"></span>
            <span class="material-symbols-outlined contact-edit"
                  title="Próximamente editable">
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
          <span class="value" id="perfilRolSistema"></span>
        </div>

        <div class="profile-item">
          <span class="label">Fecha de registro</span>
          <span class="value" id="perfilFechaRegistro"></span>
        </div>

        <div class="profile-item">
          <span class="label">Estado de cuenta</span>
          <span class="value status-active" id="perfilEstadoCuenta"></span>
        </div>
      </div>
    </div>

  </section>

  <!-- ===== PERFIL DEL PACIENTE (SIMULADO) ===== -->
  <section id="view-perfil-paciente" class="view hidden">
  
    <!-- ===== PERFIL PACIENTE (REUTILIZABLE) ===== -->
    <div id="perfilPacienteContainer">
      <!-- aquí el JS inyecta el mismo perfil que ya usas en paciente -->
    </div>

  </section>

  <!-- ===== CONSULTAS ===== -->
  <section id="view-consultas" class="view hidden">
    <main class="main">
    <div class="container-main__title">
    <h1 class="container-main__title-text">
                    Consultas
                </h1>
    </div>
    <div class="container-patient">
    <p class="container-patient__patient-dates">1. Nombre, Apellido, Cédula, Rol</p>
    <input class="container-patient__served" id="served" name="served" type="checkbox"/>
    </div>
    <div class="container-patient">
    <p class="container-patient__patient-dates">2. Nombre, Apellido, Cédula, Rol</p>
    <input class="container-patient__served" id="served" name="served" type="checkbox"/>
    </div>
    <div class="container-patient">
    <p class="container-patient__patient-dates">3. Nombre, Apellido, Cédula, Rol</p>
    <input class="container-patient__served" id="served" name="served" type="checkbox"/>
    </div>
    <div class="container-patient">
    <p class="container-patient__patient-dates">4. Nombre, Apellido, Cédula, Rol</p>
    <input class="container-patient__served" id="served" name="served" type="checkbox"/>
    </div>
    <div class="container-patient">
    <p class="container-patient__patient-dates">5. Nombre, Apellido, Cédula, Rol</p>
    <input class="container-patient__served" id="served" name="served" type="checkbox"/>
    </div>
    <button class="add-patient">
    <p class="add-patient__text">Agregar nuevo paciente</p>
    </button>
    </main>
  </section>

  <!-- ===== HISTORIAL ===== -->
  <section id="view-historial" class="view hidden">
      <main class="main">
      <div class="container-main__title">
      <h1 class="container-main__title-text">Historial</h1>
      </div>
      <div class="container-search">
        <span class="container-search__icon material-symbols-outlined">search</span>
        <input class="container-search__bar" id="search" name="search"/ type="date" placeholder="Filtrar por fecha"/>
      </div>
      <section class="medical-history-data">
      <div class="medical-history-data__dates">
      <p class="medical-history-data__date">09/11/2025</p>
      </div>
      <div class="medical-history-data__hours">
      <p class="medical-history-data__hour">9:30 a.m</p>
      </div>
      <div class="medical-history-data__ceds">
      <p class="medical-history-data__ced">v-12345678</p>
      </div>
      <div class="medical-history-data__modules">
      <p class="medical-history-data__module">Odontología</p>
      </div>
      </section>
      <section class="medical-history-data">
      <div class="medical-history-data__dates">
      <p class="medical-history-data__date">09/11/2025</p>
      </div>
      <div class="medical-history-data__hours">
      <p class="medical-history-data__hour">9:30 a.m</p>
      </div>
      <div class="medical-history-data__ceds">
      <p class="medical-history-data__ced">v-12345678</p>
      </div>
      <div class="medical-history-data__modules">
      <p class="medical-history-data__module">Medicina General</p>
      </div>
      </section>
      <section class="medical-history-data">
      <div class="medical-history-data__dates">
      <p class="medical-history-data__date">09/11/2025</p>
      </div>
      <div class="medical-history-data__hours">
      <p class="medical-history-data__hour">9:30 a.m</p>
      </div>
      <div class="medical-history-data__ceds">
      <p class="medical-history-data__ced">v-12345678</p>
      </div>
      <div class="medical-history-data__modules">
      <p class="medical-history-data__module">Medicina General</p>
      </div>
      </section>
      <section class="medical-history-data">
      <div class="medical-history-data__dates">
      <p class="medical-history-data__date">09/11/2025</p>
      </div>
      <div class="medical-history-data__hours">
      <p class="medical-history-data__hour">9:30 a.m</p>
      </div>
      <div class="medical-history-data__ceds">
      <p class="medical-history-data__ced">v-12345678</p>
      </div>
      <div class="medical-history-data__modules">
      <p class="medical-history-data__module">Psiquiatría</p>
      </div>
      </section>
      <section class="medical-history-data">
      <div class="medical-history-data__dates">
      <p class="medical-history-data__date">09/11/2025</p>
      </div>
      <div class="medical-history-data__hours">
      <p class="medical-history-data__hour">9:30 a.m</p>
      </div>
      <div class="medical-history-data__ceds">
      <p class="medical-history-data__ced">v-12345678</p>
      </div>
      <div class="medical-history-data__modules">
      <p class="medical-history-data__module">Odontologia</p>
      </div>
      </section>
      <section class="medical-history-data">
      <div class="medical-history-data__dates">
      <p class="medical-history-data__date">09/11/2025</p>
      </div>
      <div class="medical-history-data__hours">
      <p class="medical-history-data__hour">9:30 a.m</p>
      </div>
      <div class="medical-history-data__ceds">
      <p class="medical-history-data__ced">v-12345678</p>
      </div>
      <div class="medical-history-data__modules">
      <p class="medical-history-data__module">Psiquiatría</p>
      </div>
      </section>
      <section class="medical-history-data">
      <div class="medical-history-data__dates">
      <p class="medical-history-data__date">09/11/2025</p>
      </div>
      <div class="medical-history-data__hours">
      <p class="medical-history-data__hour">9:30 a.m</p>
      </div>
      <div class="medical-history-data__ceds">
      <p class="medical-history-data__ced">v-12345678</p>
      </div>
      <div class="medical-history-data__modules">
      <p class="medical-history-data__module">Medicina general</p>
      </div>
      </section>
      </main>
  </section>

  <!-- ===== ESTADÍSTICAS ===== -->
  <section id="view-estadisticas" class="view hidden">

  <div class="stats-container">

    <!-- FILTRO POR MES -->
    <div class="stats-filter-card">
      <div class="stats-filter">
        <label for="statsMonth">Filtrar por mes</label>
        <input type="month" id="statsMonth">
      </div>
    </div>

    <!-- ENCABEZADO -->
    <div class="stats-header">
      <h1>Estadísticas</h1>
      <p>Resumen general de la actividad médica</p>
    </div>

    <!-- CONTENEDOR DE KPIs (FONDO) -->
    <div class="stats-kpi-wrapper">

      <div class="stats-kpi-grid">

        <div class="stats-kpi-card">
          <span class="stats-kpi-number">42</span>
          <span class="stats-kpi-label">Consultas realizadas</span>
        </div>

        <div class="stats-kpi-card">
          <span class="stats-kpi-number">37</span>
          <span class="stats-kpi-label">Historias clínicas</span>
        </div>

        <div class="stats-kpi-card">
          <span class="stats-kpi-number">18</span>
          <span class="stats-kpi-label">Pacientes activos</span>
        </div>

      </div>

    </div>

    <!-- DISTRIBUCIÓN POR MÓDULO -->
    <div class="stats-card">

      <h2>Historias por módulo</h2>

      <div class="stats-bar">
        <span>Medicina General</span>
        <div class="bar">
          <div class="bar-fill" style="width: 55%"></div>
        </div>
        <span class="bar-value">18</span>
      </div>

      <div class="stats-bar">
        <span>Psiquiatría</span>
        <div class="bar">
          <div class="bar-fill" style="width: 30%"></div>
        </div>
        <span class="bar-value">11</span>
      </div>

      <div class="stats-bar">
        <span>Odontología</span>
        <div class="bar">
          <div class="bar-fill" style="width: 20%"></div>
        </div>
        <span class="bar-value">8</span>
      </div>

    </div>

    <!-- ACTIVIDAD RECIENTE -->
    <div class="stats-card">

      <h2>Actividad reciente</h2>

      <ul class="stats-activity-list">
        <li>Historia clínica – María González (Hoy)</li>
        <li>Consulta atendida – José Rodríguez (Ayer)</li>
        <li>Historia odontológica – Ana Pérez (Ayer)</li>
      </ul>

    </div>

  </div>

  <!-- =======REGISTRAR MEDICOS (ESPECIALISTAS)========= -->
<!-- OVERLAY REGISTRO DE ESPECIALISTAS (JEFE MÉDICO) -->
<section id="crearMedicoOverlay" class="oai-backdrop oai-hidden">

  <button id="btnCerrarCrearMedico" class="btn-cerrar-overlay" type="button">
      ✕
  </button>
  
  <div class="oai-frame-drawer auth-box">

    <!-- TITULO -->
    <h2 style="text-align:center;margin-bottom:6px;">
      Registro de Médicos
    </h2>

    <!-- FORMULARIO -->
    <form
      id="formCrearMedico"
      data-form="crear-medico"
      method="POST"
      action="{{ route('jefeMedico') }}"
    >
    @csrf
      <!-- IDENTIFICADOR PARA BACKEND -->
      <input type="hidden" name="form_tipo" value="CREAR_MEDICO">

      <label for="med_nombre">Nombre:</label>
      <input
        type="text"
        name="med_nombre"
        required
      >

      <label for="med_apellido">Apellido:</label>
      <input
        type="text"
        name="med_apellido"
        required
      >

      <label for="med_cedula">Cédula:</label>
      <input
        type="text"
        name="med_cedula"
        placeholder="V12345678"
        pattern="[VvEeJjPp]{1}[0-9]{5,9}"
        title="Formato válido: V12345678"
        required
      >

      <label for="med_correo">Correo:</label>
      <input
        type="email"
        name="med_correo"
        required
      >

      <label for="med_direccion">Dirección:</label>
      <input
        type="text"
        name="med_direccion"
        required
      >

      <label for="med_telefono">Teléfono:</label>
      <input
        type="tel"
        name="med_telefono"
        required
      >
      <label for="med_fecha_nacimiento">Fecha de Nacimiento:</label>
      <input
        type="date"
        name="med_fecha-nacimiento"
        required
      >
    
      <label for="selectSexoMedico">Sexo:</label>
      <select id="selectSexoMedico" name="med_sexo" class="select-placeholder" required>
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
        <option value="Otro">Otro</option>
      </select>

      <label for="selectEstadoCivilMedico">Estado Civil:</label>
      <select id="selectEstadoCivilMedico" name="med_estado_civil" class="select-placeholder" required>
        <option value="Soltero(a)">Soltero(a)</option>
        <option value="Casado(a)">Casado(a)</option>
        <option value="Divorciado(a)">Divorciado(a)</option>
        <option value="Viudo(a)">Viudo(a)</option>
      </select>

      <label for="selectEspecialidad">Especialidad:</label>
      <select id="selectEspecialidad" name="med_especialidad" class="select-placeholder" required>
        <option value="1">Medicina General</option>
        <option value="2">Odontología</option>
        <option value="3">Psiquiatría</option>
        <option value="4">Traumatología</option>
      </select>

      <div id="crearMedicoMsg" class="form-msg oai-hidden">

      </div>
      <!-- BOTONES -->
      <div style="display:flex;gap:12px;margin-top:18px;">

        <button
          id="registrarEspecialidad"
          type="submit"
          class="btn-primario"
        >
          Registrar Especialista
        </button>
      </div>

    </form>
    
  </div>
</section>

<!-- =======REGISTRAR FAMILIARES========= -->
<section id="crearFamiliarOverlay" class="oai-backdrop oai-hidden">

  <button id="btnCerrarCrearFamiliar" class="btn-cerrar-overlay" type="button">
      ✕
  </button>

  <div class="oai-frame-drawer auth-box">

    <!-- TITULO -->
    <h2 style="text-align:center;margin-bottom:6px;">
      Registro de Familiares
    </h2>

    <!-- FORMULARIO -->
    <form
      id="formCrearFamiliar"
      data-form="crear-familiar"
      method="POST" 
      action="{{ route('pacientePersonal') }}"
    >

      <!-- IDENTIFICADOR PARA BACKEND -->
      <input type="hidden" name="form_tipo" value="CREAR_FAMILIAR">

      <label for="fam_nombre">Nombre:</label>
      <input
        type="text"
        name="fam_nombre"
        required
      >

      <label for="fam_apellido">Apellido:</label>
      <input
        type="text"
        name="fam_apellido"
        required
      >
    
      <label for="fam_cedula">Cédula:</label>
      <input
        type="text"
        name="fam_cedula"
        placeholder="V12345678"
        pattern="[VvEeJjPp]{1}[0-9]{5,9}"
        title="Formato válido: V12345678"
        required
      >
    
      <label for="fam_correo">Correo:</label>
      <input
        type="email"
        name="fam_correo"
        required
      >

      <label for="fam_direccion">Dirección:</label>
      <input
        type="text"
        name="fam_direccion"
        required
      >
        
      <label for="fam_telefono">Teléfono:</label>
      <input
        type="tel"
        name="fam_telefono"
        required
      >
      
      <label for="fam_fecha_nacimiento">Fecha de Nacimiento:</label>
      <input
        type="date"
        name="fam_fecha_nacimiento"
        required
      >

      <label for="selectSexofamiliar">Sexo:</label>
      <select id="selectSexofamiliar" name="fam_sexo" class="select-placeholder" required>
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
        <option value="Otro">Otro</option>
      </select>

      <label for="selectEstadoCivilfamiliar">Estado Civil:</label>
      <select id="selectEstadoCivilfamiliar" name="fam_estado_civil" class="select-placeholder" required>
        <option value="Soltero(a)">Soltero(a)</option>
        <option value="Casado(a)">Casado(a)</option>
        <option value="Divorciado(a)">Divorciado(a)</option>
        <option value="Viudo(a)">Viudo(a)</option>
      </select>

      <div id="crearFamiliarMsg" class="form-msg oai-hidden">

      </div>
      <!-- BOTONES -->
      <div style="display:flex;gap:12px;margin-top:18px;">

        <button
          id="registrarEspecialidad"
          type="submit"
          class="btn-primario"
        >
          Registrar Familiar
        </button>
      </div>

    </form>

  </div>

</section>

</main>

<!-- ================= JS ================= -->
<script src="js/app_unificado.js"></script>

<!-- ===== Overlays base (NO se tocan) ===== -->
<div class="oai-backdrop oai-hidden" id="oaiBackdrop"></div>
<div class="oai-frame-drawer oai-hidden" id="oaiDrawerWrap">
  <iframe id="oaiDrawerFrame" title="Menú"></iframe>
</div>
<div class="oai-frame-modal oai-hidden" id="oaiModalWrap">
  <iframe id="oaiModalFrame" title="Formulario"></iframe>
</div>

@endsection