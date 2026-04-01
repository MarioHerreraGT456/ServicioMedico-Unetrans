@extends('layouts.app')

@section('content')
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
        <form method="GET" action="{{ route('usuarios.inactivar') }}" class="form-buscar">
          @csrf
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
     @if (!request('buscar'))
      <div class="" id="mensajeBuscarPaciente">
        <span>Por favor, ingresar la cédula del paciente</span>
      </div>
      @endif
    <div style="display: flex; justify-content: center; width: 100%;">
    <div style="width: 100%; max-width: 900px;">
      
      <!--DE AQUI EN ADELANTE EL PERFIL-->
      <section id="view-perfil" class="view" style="display: flex; flex-direction: column; gap: 20px;">

       @if(request('buscar'))

    {{-- CASO: EXISTE PERO NO ES MÉDICO --}}
    @if($noEsMedico)
        <div class="alert-no-results">
            <span>El usuario encontrado no es un médico</span>
        </div>

    {{-- CASO: NO EXISTEN RESULTADOS --}}
    @elseif($resultados->isEmpty())
        <div class="alert-no-results">
            <span>No se encontraron médicos con este número de documento</span>
        </div>

    {{-- CASO: HAY RESULTADOS --}}
    @else

        @foreach($resultados as $persona)
        <div class="perfil-container-card">
    <div class="profile-main-content">
        <div class="profile-sidebar">
            <div class="profile-avatar">
                <img src="{{ $persona->foto ? asset('storage/' . $persona->foto) : asset('img/perfil.jpg') }}" alt="Foto">
            </div>
            <div class="profile-identidad">
                <h2 class="profile-full-name">{{ $persona->nombre }} {{ $persona->apellido }}</h2>
                <span class="status-indicator">
                    Estado de Cuenta: 
                    <span class="estado-text {{ $persona->estado ? 'status-active' : 'status-inactive' }}">
                        {{ $persona->estado ? 'Activo' : 'Inactivo' }}
                    </span>
                </span>
            </div>
        </div>

        <div class="profile-details-wrapper">
            <div class="profile-info-grid">
                <div class="info-section">
                    <h3 class="section-title">DATOS PERSONALES</h3>
                    <div class="data-row"><span class="label">CÉDULA</span> <span class="value">{{ $persona->tipo }}-{{ $persona->cedula }}</span></div>
                    <div class="data-row"><span class="label">ESTADO CIVIL</span> <span class="value">{{ $persona->estado_civil }}</span></div>
                    <div class="data-row"><span class="label">EDAD</span> <span class="value">{{ \Carbon\Carbon::parse($persona->fecha_nacimiento)->age }} años</span></div>
                    <div class="data-row"><span class="label">SEXO</span> <span class="value">{{ $persona->sexo }}</span></div>
                </div>

                <div class="info-section">
                    <h3 class="section-title">CONTACTO</h3>
                    <div class="data-row"><span class="label">TELÉFONO</span> <span class="value">{{ $persona->codigo }}-{{ $persona->telefono }}</span></div>
                    <div class="data-row"><span class="label">CORREO</span> <span class="value text-lowercase">{{ $persona->correo }}</span></div>
                    <div class="data-row"><span class="label">DIRECCIÓN</span> <span class="value">{{ $persona->direccion }}</span></div>
                </div>
            </div>

            <hr class="divider">

            <div class="profile-footer-content">
                <div class="history-section">
                    <h3 class="section-title">Historial de Cuenta</h3>
                      <div class="data-row"><span class="label">REGISTRO</span> <span class="value">
                        {{ \Carbon\Carbon::parse($persona->created_at)->format('d/m/Y') }} </span>
                      </div>
                      <div class="data-row"><span class="label">ROL</span> <span class="value">
                        {{ ucfirst($persona->rol) }}</span>
                      </div> 
                </div>

                <div class="actions-section">
                    <form method="POST" action="{{ route('usuarios.estado', $persona->cedula) }}" 
                    class="form-estado">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn-estado {{ $persona->estado ? 'btn-inactivar' : 'btn-activar' }}">
                            <span class="material-symbols-outlined">
                                {{ $persona->estado ? 'power_settings_new' : 'check_circle' }}
                            </span>
                            {{ $persona->estado ? 'Inactivar Usuario' : 'Activar Usuario' }}
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
        @endforeach

    @endif

@endif
    {{-- botones
     --}}
    </section>
    </div>

    {{-- <section id="view-perfil" class="view hidden">
      <h2>Perfil</h2>
      <p>Preparado para integración backend.</p>
    </section> --}}

    {{-- <section id="view-consultas" class="view hidden">
      <h2>Consultas</h2>

      <form method="GET" action="" class="toolbar">
        <div class="tool">
          <label>Desde</label>
          <input type="date" name="desde_consulta" value="{{ request('desde_consulta') }}">
        </div>
        <div class="tool">
          <label>Hasta</label>
          <input type="date" name="hasta_consulta" value="{{ request('hasta_consulta') }}">
        </div>
        <div class="tool tool-actions">
          <button type="submit" class="btn-primary">Buscar</button>
          <a class="btn-secondary" href="{{ url()->current() }}">Limpiar</a>
        </div>
      </form>

      <div class="list-empty">
        <p>No hay consultas para mostrar (pendiente de integración backend).</p>
      </div>

      <div id="consultasList" class="list"></div>

    
      <div class="section-actions">
        <button type="button" class="btn-primary" data-action="open-consulta-form">Nueva Consulta</button>
      </div>

      <div id="consultaFormWrap" class="hidden">
        <h3>Nueva Consulta</h3>
        <p class="muted">Formulario preparado para backend (action/método lo definirá el backend).</p>

        <form method="POST" action="" class="form-grid">
          @csrf

          <div class="campo"><label>Nombres y Apellidos</label><input type="text" name="nombre_apellido"></div>
          <div class="campo"><label>Cédula</label><input type="text" name="cedula"></div>
          
          <div class="campo"><label>Sexo</label>
            <select name="sexo">
              <option value="M">M</option>
              <option value="F">F</option>
            </select>
          </div>

          <div class="campo"><label>Peso</label><input type="text" name="peso"></div>
          <div class="campo"><label>Talla</label><input type="text" name="talla"></div>
          <div class="campo"><label>T/A</label><input type="text" name="ta"></div>

          <div class="campo campo-full"><label>Motivo de consulta</label><textarea name="motivo" rows="3"></textarea></div>
          <div class="campo campo-full"><label>Tratamiento</label><textarea name="tratamiento" rows="3"></textarea></div>

          <div class="campo"><label>Fecha</label><input type="date" name="fecha"></div>
          <div class="campo"><label>Doctor</label><input type="text" name="doctor"></div>

          <div class="tool-actions campo-full">
            <button type="submit" class="btn-primary">Guardar (backend)</button>
            <button type="button" class="btn-secondary" data-action="close-consulta-form">Cancelar</button>
          </div>
        </form>
      </div>
    </section> --}}

    {{-- <section id="view-historial" class="view hidden">
      <h2>Historial</h2>

      <form method="GET" action="" class="toolbar">
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

      <div class="list-empty">
        <p>No hay elementos para mostrar (pendiente de integración backend).</p>
      </div>

      <div id="historyList" class="list"></div>

      <div class="section-actions">
        <button type="button" class="btn-primary" data-action="open-historia-form">Crear Historia</button>
      </div>

      <div id="historiaFormWrap" class="hidden">
        <h3>Nueva Historia</h3>
        <p class="muted">Formulario preparado (backend definirá campos exactos y guardado).</p>

        <form method="POST" action="" class="form-grid">
          @csrf
          <div class="campo campo-full"><label>Contenido</label><textarea name="contenido" rows="6"></textarea></div>
          <div class="tool-actions campo-full">
            <button type="submit" class="btn-primary">Guardar (backend)</button>
            <button type="button" class="btn-secondary" data-action="close-historia-form">Cancelar</button>
          </div>
        </form>
      </div>
    </section> --}}

    {{-- <section id="view-detalle" class="view hidden">
      <h2>Detalle</h2>
      <div class="detail-card">
        <p class="muted">Preparado para mostrar detalle cuando el backend lo inyecte.</p>
        <div id="detailBody"></div>
        <button type="button" class="btn-secondary" data-action="back">Volver</button>
      </div>
    </section> --}}
{{-- 
    <div id="crearFamiliarOverlay" class="hidden"></div> --}}

  </main>
</div>
<script> window.csrfToken = "{{ csrf_token() }}"; </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/inactivar.js"></script>
<script src="js/profile.js" defer></script>
<script src="js/auth-overlay.js" defer></script>
<script src="js/app.js"></script>
@endsection