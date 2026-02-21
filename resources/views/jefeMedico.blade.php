@extends('layouts.app')

@section('content')
<div class="dashboard">

  <!-- ================= MENU LATERAL JEFE MÉDICO ================= -->
  <aside id="sidebarMedico" class="sidebar">

    <div class="sidebar__header">
      <img src="img/perfil.jpg" alt="Perfil">
      <span class="sidebar__name"></span>
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

  <main class="main-content" id="viewsJefeMedico">

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

  <section id="view-consultas" class="view hidden">

  <div class="section-header">
    <h2>Consultas</h2>
    <button type="button" class="btn-primary" data-action="open-consulta-form">
      Nueva Consulta
    </button>
  </div>

  {{-- FILTROS --}}
  <form method="GET" action="{{ url()->current() }}" class="toolbar">

    <div class="tool">
      <label>Desde</label>
      <input type="date" name="desde" value="{{ request('desde') }}">
    </div>

    <div class="tool">
      <label>Hasta</label>
      <input type="date" name="hasta" value="{{ request('hasta') }}">
    </div>

    <div class="tool tool-actions">
      <button type="submit" class="btn-primary">Buscar</button>
      <a class="btn-secondary" href="{{ url()->current() }}">Limpiar</a>
    </div>

  </form>

  {{-- LISTA DE CONSULTAS --}}
  <div class="consultas-container">

    @if(isset($consultas) && $consultas->isEmpty())
      <div class="empty-state">
        <p>No hay consultas registradas.</p>
      </div>
    @endif

    @if(isset($consultas))
      @foreach($consultas as $consulta)

        <div class="consulta-row">

          <div class="consulta-col">
            <strong>{{-- {{ $consulta->fecha }} --}}</strong>
            <p>{{-- {{ $consulta->nombres }} --}} {{-- {{ $consulta->apellidos }} --}}</p>
          </div>

          <div class="consulta-col">
            <p>Cédula: {{-- {{ $consulta->cedula }} --}}</p>
            <p>Edad: {{-- {{ $consulta->edad }} --}}</p>
          </div>

          <div class="consulta-col">
            <p>Sexo: {{-- {{ $consulta->sexo }} --}}</p>
            <p>Médico: {{-- {{ $consulta->doctor->nombre ?? '' }} --}}</p>
          </div>

          <div class="consulta-actions">
            <a
              href="#"
              {{-- href="{{ route('consultas.show', $consulta->id) }}" --}}
              class="btn-secondary"
            >
              Ver Detalle
            </a>
          </div>

        </div>

      @endforeach
    @endif

  </div>

  {{-- FORMULARIO OCULTO NUEVA CONSULTA --}}
  <div id="consultaFormWrap" class="modal-wrap hidden">

    <div class="modal-card">

      <div class="modal-header">
        <h3>Nueva Consulta</h3>
        <button type="button" class="btn-secondary" data-action="close-consulta-form">
          Cerrar
        </button>
      </div>

      <form method="POST" action="{{-- route('consultas.store') --}}" class="form-grid">
        @csrf

        <div class="form-group">
          <label>Nombres</label>
          <input type="text" name="nombres" required>
        </div>

        <div class="form-group">
          <label>Apellidos</label>
          <input type="text" name="apellidos" required>
        </div>

        <div class="form-group">
          <label>Cédula</label>
          <input type="text" name="cedula" required>
        </div>

        <div class="form-group">
          <label>Edad</label>
          <input type="number" name="edad" required>
        </div>

        <div class="form-group">
          <label>Sexo</label>
          <select name="sexo" required>
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
          </select>
        </div>

        <div class="form-group">
          <label>Peso</label>
          <input type="text" name="peso">
        </div>

        <div class="form-group">
          <label>Talla</label>
          <input type="text" name="talla">
        </div>

        <div class="form-group">
          <label>Tensión Arterial</label>
          <input type="text" name="ta">
        </div>

        <div class="form-group full">
          <label>Motivo de Consulta</label>
          <textarea name="motivo" rows="3"></textarea>
        </div>

        <div class="form-group full">
          <label>Tratamiento</label>
          <textarea name="tratamiento" rows="3"></textarea>
        </div>

        <div class="form-group">
          <label>Fecha</label>
          <input type="date" name="fecha" required>
        </div>

        <div class="form-group">
          <label>Doctor</label>
          <input type="text" name="doctor" required>
        </div>

        <div class="form-actions full">
          <button type="submit" class="btn-primary">Guardar Consulta</button>
        </div>

      </form>

    </div>

  </div>

</section>

  <section id="view-historial" class="view hidden">

  <div class="section-header">
    <h2>Historial</h2>
  </div>

  {{-- FILTROS --}}
  <form method="GET" action="{{ url()->current() }}" class="toolbar">

    <div class="tool">
      <label>Desde</label>
      <input type="date" name="desde" value="{{ request('desde') }}">
    </div>

    <div class="tool">
      <label>Hasta</label>
      <input type="date" name="hasta" value="{{ request('hasta') }}">
    </div>

    <div class="tool">
      <label>Tipo</label>
      <select name="tipo">
        <option value="" {{ request('tipo')=='' ? 'selected' : '' }}>Todos</option>
        <option value="consulta" {{ request('tipo')=='consulta' ? 'selected' : '' }}>Consultas</option>
        <option value="historia" {{ request('tipo')=='historia' ? 'selected' : '' }}>Historias</option>
      </select>
    </div>

    <div class="tool tool-actions">
      <button type="submit" class="btn-primary">Buscar</button>
      <a class="btn-secondary" href="{{ url()->current() }}">Limpiar</a>
    </div>

  </form>

  {{-- LISTA REAL DEL HISTORIAL --}}
  <div class="history-container">

    {{-- CUANDO NO HAY DATOS --}}
    @if(isset($historial) && $historial->isEmpty())
      <div class="empty-state">
        <p>No hay elementos para mostrar.</p>
      </div>
    @endif

    {{-- CUANDO HAY DATOS --}}
    @if(isset($historial))
      @foreach($historial as $item)

        <div class="history-card">

          <div class="history-main">
            <h4>
              {{-- {{ ucfirst($item->tipo) }} --}}
              Tipo
            </h4>

            <p>
              Fecha:
              {{-- {{ $item->fecha }} --}}
            </p>

            <p>
              Paciente:
              {{-- {{ $item->paciente->nombre ?? '' }} --}}
            </p>
          </div>

          <div class="history-actions">
            <a
              href="#"
              {{-- href="{{ route('detalle.show', $item->id) }}" --}}
              class="btn-secondary"
            >
              Ver Detalle
            </a>
          </div>

        </div>

      @endforeach
    @endif

  </div>

</section>

    <section id="view-reportes" class="view hidden">
      <h2>Reportes Mensuales</h2>

      <div class="report-header">
        <div>
          <p class="muted">Próximo reporte disponible en:</p>
          <div id="reportsCountdown" class="countdown">--:--:--</div>
        </div>
      </div>

      {{-- Filtro por Mes --}}
      <form method="GET" action="" class="toolbar">
        <div class="tool">
          <label>Mes</label>
          <select name="mes">
            <option value="">Todos</option>
            <option value="1"  {{ request('mes')=='1' ? 'selected' : '' }}>Enero</option>
            <option value="2"  {{ request('mes')=='2' ? 'selected' : '' }}>Febrero</option>
            <option value="3"  {{ request('mes')=='3' ? 'selected' : '' }}>Marzo</option>
            <option value="4"  {{ request('mes')=='4' ? 'selected' : '' }}>Abril</option>
            <option value="5"  {{ request('mes')=='5' ? 'selected' : '' }}>Mayo</option>
            <option value="6"  {{ request('mes')=='6' ? 'selected' : '' }}>Junio</option>
            <option value="7"  {{ request('mes')=='7' ? 'selected' : '' }}>Julio</option>
            <option value="8"  {{ request('mes')=='8' ? 'selected' : '' }}>Agosto</option>
            <option value="9"  {{ request('mes')=='9' ? 'selected' : '' }}>Septiembre</option>
            <option value="10" {{ request('mes')=='10' ? 'selected' : '' }}>Octubre</option>
            <option value="11" {{ request('mes')=='11' ? 'selected' : '' }}>Noviembre</option>
            <option value="12" {{ request('mes')=='12' ? 'selected' : '' }}>Diciembre</option>
          </select>
        </div>

        {{ -- Filtro por año --}}
        <div class="tool">
          <label>Año</label>
          <input type="number" name="anio" min="2000" max="2100" value="{{ request('anio') }}">
        </div>

        <div class="tool tool-actions">
          <button type="submit" class="btn-primary">Buscar</button>
          <a class="btn-secondary" href="{{ url()->current() }}">Limpiar</a>
        </div>
      </form>

      {{-- Lista vacía --}}
      <div class="list-empty">
        <p>No hay reportes disponibles aún.</p>
      </div>

      {{ -- Contenedor para lista real --}}
      <div id="reportList" class="list"></div>

      {{-- Ejemplo de botón “descargar” --}}
      <div class="report-actions">

        <a
          href="{{ route('reportes.pdf', ['mes' => request('mes'), 'anio' => request('anio')]) }}"
          target="_blank"
          class="btn-primary"
        >
          Descargar Reporte
        </a>

      </div>

    </section>

   <section id="view-detalle" class="view hidden">

    <div class="detail-header">
      <h2>Detalle Clínico</h2>
      <button type="button" class="btn-secondary" data-action="back">Volver</button>
    </div>

    <div class="detail-card">

      {{-- DATOS GENERALES --}}
      <div class="detail-section">
        <h3>Información General</h3>

        <div class="detail-grid">

          <div class="detail-item">
            <label>Tipo:</label>
            <span>
              {{-- {{ $detalle->tipo ?? '' }} --}}
            </span>
          </div>

          <div class="detail-item">
            <label>Fecha:</label>
            <span>
              {{-- {{ $detalle->fecha ?? '' }} --}}
            </span>
          </div>

          <div class="detail-item">
            <label>Creado por:</label>
            <span>
              {{-- {{ $detalle->usuario->nombre ?? '' }} --}}
            </span>
          </div>

          <div class="detail-item">
            <label>Estado:</label>
            <span>
              {{-- {{ $detalle->estado ?? '' }} --}}
            </span>
          </div>

        </div>
      </div>

      {{-- DATOS DEL PACIENTE --}}
      <div class="detail-section">
        <h3>Datos del Paciente</h3>

        <div class="detail-grid">

          <div class="detail-item">
            <label>Nombre:</label>
            <span>
              {{-- {{ $detalle->paciente->nombre ?? '' }} --}}
            </span>
          </div>

          <div class="detail-item">
            <label>Cédula:</label>
            <span>
              {{-- {{ $detalle->paciente->cedula ?? '' }} --}}
            </span>
          </div>

          <div class="detail-item">
            <label>Edad:</label>
            <span>
              {{-- {{ $detalle->paciente->edad ?? '' }} --}}
            </span>
          </div>

          <div class="detail-item">
            <label>Sexo:</label>
            <span>
              {{-- {{ $detalle->paciente->sexo ?? '' }} --}}
            </span>
          </div>

        </div>
      </div>

      {{-- CONTENIDO CLÍNICO --}}
      <div class="detail-section">
        <h3>Contenido Clínico</h3>

        <div class="detail-content">
          {{-- {{ $detalle->contenido ?? '' }} --}}
        </div>
      </div>

      {{-- OBSERVACIONES --}}
      <div class="detail-section">
        <h3>Observaciones</h3>

        <div class="detail-content">
          {{-- {{ $detalle->observaciones ?? '' }} --}}
        </div>
      </div>

    </div>

  </section>

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

    <div id="crearFamiliarOverlay" class="hidden"></div>

  </main>
</div>
@endsections