@extends('layouts.app')

@section('content')
<div class="dashboard">

 

  <main class="main-content" id="viewsMedico">

    <section id="view-inicio" class="view">
      <h2>Inicio</h2>
      <p>Panel de gestión para Médico.</p>
    </section>
    <!-- ===== INICIO ===== -->
  <section id="view-inicio" class="view">
    <div class="container-welcome">
      <h1>Bienvenido al Servicio Médico</h1>
    </div>


    <div class="contenedor-principal">
    <div class="columna-setenta">
        <p>Esta es la columna del 70%.</p>
    </div>
    <div class="columna-treinta">
      @if (
        $medico->especialidad === 'general' 
      )
        <section class="container-services__general-medicine">
        <div class="container-services__img">
          <img src="img/medicina_general.jpg"
               alt="medicina general"
               class="container-services__img-general-medicine"
               onerror="this.style.display='none'"/>
        </div>
      </section>
      @endif
  @if($medico->especialidad === 'odontologia')
      <section class="container-services__dentistry">
        <div class="container-services__img">
          <img src="img/odontologia.jpg"
               alt="odontología"
               class="container-services_img-dentistry"
               onerror="this.style.display='none'"/>
        </div>
      </section>
      @endif
      @if($medico->especialidad === 'psiquiatria')
        <section class="container-services__psychiatry">
        <div class="container-services__container-img">
          <img src="img/psquitria.jpg"
               alt="psiquiatría"
               class="container-services_img-psychiatry"
               onerror="this.style.display='none'"/>
        </div>
      </section>
      @endif
    </div>
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
          <div class="campo"><label>Edad</label><input type="number" name="edad"></div>
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

<script src="js/profile.js" defer></script>
<script src="js/auth-overlay.js" defer></script>
<script src="js/app.js"></script>
@endsection