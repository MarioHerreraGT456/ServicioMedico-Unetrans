@extends('layouts.app')

@section('content')
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

  <!-- ===== PERFIL MÉDICO ===== -->
    <section id="view-perfil" class="view hidden">

  <!-- ===== PERFIL HEADER ===== -->
  <div class="profile-header-card">
    <div class="profile-avatar">
      <img src="img/perfil.jpg" alt="Foto de perfil"
           onerror="this.style.display='none'">
    </div>

    <div class="profile-main-info">
      <h2 class="profile-name">Juan Pérez</h2>
      <span class="profile-role">Médico
      </span>
      <span class="profile-status active">Activo</span>
    </div>
  </div>

  <!-- ===== DATOS PERSONALES ===== -->
  <div class="profile-card">
    <h3 class="profile-card-title">Datos personales</h3>

    <div class="profile-grid">
      <div class="profile-item">
        <span class="label">Cédula</span>
        <span class="value">V-12.345.678</span>
      </div>

      <div class="profile-item">
        <span class="label">Fecha de nacimiento</span>
        <span class="value">12/05/1999</span>
      </div>

      <div class="profile-item">
        <span class="label">Edad</span>
        <span class="value">25 años</span>
      </div>

      <div class="profile-item">
        <span class="label">Sexo</span>
        <span class="value">Masculino</span>
      </div>

      <div class="profile-item">
        <span class="label">Estado civil</span>
        <span class="value">Soltero</span>
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
        <span>paciente@email.com</span>
        <span class="material-symbols-outlined contact-edit"
              title="Próximamente editable">
          edit
        </span>
      </div>
    </div>

    <div class="profile-contact-item">
      <span class="contact-label">Teléfono</span>

      <div class="contact-value">
        <span>0412-1234567</span>
        <span class="material-symbols-outlined contact-edit"
              title="Próximamente editable">
          edit
        </span>
      </div>
    </div>

    <div class="profile-contact-item">
      <span class="contact-label">Dirección</span>

      <div class="contact-value">
        <span>Caracas, Venezuela</span>
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
        <span class="value">Médico</span>
      </div>

      <div class="profile-item">
        <span class="label">Fecha de registro</span>
        <span class="value">10/01/2024</span>
      </div>

      <div class="profile-item">
        <span class="label">Estado de cuenta</span>
        <span class="value status-active">Activa</span>
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

</section>

</main>

<script src="js/app.js"></script>

<!-- ===== Overlays base (NO se tocan) ===== -->
<div class="oai-backdrop oai-hidden" id="oaiBackdrop"></div>
<div class="oai-frame-drawer oai-hidden" id="oaiDrawerWrap">
  <iframe id="oaiDrawerFrame" title="Menú"></iframe>
</div>
<div class="oai-frame-modal oai-hidden" id="oaiModalWrap">
  <iframe id="oaiModalFrame" title="Formulario"></iframe>
</div>
@endsection