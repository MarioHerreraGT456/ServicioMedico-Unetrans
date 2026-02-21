@extends('layouts.app')

@section('content')
<!-- ================= MENU LATERAL PACIENTE ================= -->
<aside id="sidebarPaciente" class="sidebar">
  <div class="sidebar__header">
    <img src="img/perfil.jpg" alt="Perfil">
    <span class="sidebar__name">Paciente</span>
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
    
    <button class="sidebar__item" data-view="historias">
      <span class="material-symbols-outlined">folder</span>
      Historias
    </button>

   <button class="sidebar__item sidebar__item--cerrar" id="btnCerrarMenu">
      <span class="material-symbols-outlined">close</span>
      Cerrar Menú
    </button>

  </nav>

</aside>

<main class="main-content" id="viewsPaciente">

  <!-- ===== INICIO ===== -->
  <section id="view-inicio" class="view">
    <div class="container-welcome">
      <h1>Bienvenido al Servicio Médico</h1>
    </div>

    <div class="container-services">
      <section class="container-services__general-medicine">
        <div class="container-services__img">
          <img src="img/medicina_general.jpg"
               alt="medicina general"
               class="container-services__img-general-medicine"
               onerror="this.style.display='none'"/>
        </div>
      </section>

      <section class="container-services__dentistry">
        <div class="container-services__img">
          <img src="img/odontologia.jpg"
               alt="odontología"
               class="container-services_img-dentistry"
               onerror="this.style.display='none'"/>
        </div>
      </section>

      <section class="container-services__psychiatry">
        <div class="container-services__container-img">
          <img src="img/psquitria.jpg"
               alt="psiquiatría"
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
      <h2 class="profile-name">Juan Pérez</h2>
      <span class="profile-role">Paciente</span>
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
        <span class="value">Paciente</span>
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

  <!-- ===== HISTORIAS ===== -->
  <section id="view-historias" class="view hidden">

  <!-- ===== MÓDULOS ===== -->
  <div class="histories-wrapper" id="histories-modules">

    <div class="histories-header">
      <h2>Historias clínicas</h2>
    </div>

    <div class="histories-grid">

      <div class="history-card" data-module="medicina">
        <div class="history-icon">
          <span class="material-symbols-outlined">stethoscope</span>
        </div>
        <div class="history-info">
          <h3>Medicina General</h3>
          <p>Historias clínicas generales</p>
        </div>
      </div>

      <div class="history-card" data-module="odontologia">
        <div class="history-icon">
          <span class="material-symbols-outlined">dentistry</span>
        </div>
        <div class="history-info">
          <h3>Odontología</h3>
          <p>Historias odontológicas</p>
        </div>
      </div>

      <div class="history-card" data-module="psiquiatria">
        <div class="history-icon">
          <span class="material-symbols-outlined">psychology</span>
        </div>
        <div class="history-info">
          <h3>Psiquiatría</h3>
          <p>Salud mental</p>
        </div>
      </div>

    </div>
  </div>

  <!-- ===== ESTADO VACÍO ===== -->
  <div class="histories-wrapper hidden" id="histories-empty">
    <div class="histories-header">
      <h2 id="histories-module-title"></h2>
    </div>

    <div class="history-empty-box">
      <span class="material-symbols-outlined">folder_off</span>
      <p>No hay historias clínicas creadas todavía.</p>
    </div>
  </div>

  <!-- ===== LISTA REAL (BACKEND) ===== -->
  <div class="histories-wrapper hidden" id="histories-list">
    <!-- Aquí se renderizarán las historias reales -->
  </div>

</section>

</section>

  <!-- ===== SOLICITAR ACCESO ===== -->
  <section id="view-solicitar" class="view hidden">
      <main class="main">
        <div class="container-main__request-access">
        <div class="container-main__profile">
        <img alt="foto de perfil" class="container-main__photo" onerror="this.style.display='none'" src="img/perfil.jpg"/>
        </div>
        <div class="container__text">
        <p class="container__paragraph">
                            Si desea registrar una persona que no es miembro de la comunidad universitaria, 
                            debe realizar una petición de aceptación al jefe del servicio médico
                        </p>
        </div>
        <div class="container__application">
        <div class="container__application-dates">
        <label for="ced">Cédula:</label>
        <input class="container__application-ced" id="ced" maxlength="9" name="ced" pattern="^[VJEG]{1}[0-9]{7,8}$" required="" type="text"/>
        <label for="reasons">Exposición de Motivos:</label>
        <input class="container-application__reasons" id="reasons" maxlength="5000" name="reasons" required="" type="text"/>
        <button class="container-main__btn" type="submit">Enviar</button>
        </div>
        </div>
        </div>
      </main>
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