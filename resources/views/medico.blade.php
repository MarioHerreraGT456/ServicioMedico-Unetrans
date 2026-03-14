@extends('layouts.app')

@section('content')
<div class="dashboard">

 

  <main class="main-content" id="viewsMedico">

    <!-- ===== INICIO ===== -->
  <section id="view-inicio" class="view">
    <div class="container-welcome">
      <h1>Bienvenido al Servicio Médico</h1>
    </div>

    <div class="container-search">
        <!--ESTA ES LA BARRA DE BUSQUEDA-->
        <span class="container-search__icon material-symbols-outlined">
          search
        </span>
        <form method="GET" action="{{ route('medico.dashboard') }}" class="form-buscar">
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
    <div class="contenedor-principal">
    <div class="columna-setenta">
      <!--<p>Esta es la columna del 70%.</p>-->
      
      <!--MENSAJE PARA CUANDO NO HAY NADA EN EL BUSCADOR-->
      @if (!request('buscar'))
      <div class="" id="mensajeBuscarPaciente">
        <span>Por favor, ingresar la cédula del paciente</span>
      </div>
      @endif
      
      <!--DE AQUI EN ADELANTE EL PERFIL-->
      <section id="view-perfil" class="view" style="display: flex; flex-direction: column; gap: 20px;">
        @foreach($resultados as $persona)
            @php
                // Buscamos si la persona actual es un FAMILIAR (está en la columna 'cedula' de la tabla personal)
                $relacion = \App\Models\Familiar::where('cedula2', $persona->cedula)->first();
            @endphp

            @if($relacion)
                {{-- --- CASO A: ES UN FAMILIAR (Mostramos 2 cards: Familiar y luego Titular) --- --}}
                
                <div class="profile-header-card-result" style="border-left: 5px solid #276fc2;">
                    <div class="profile-photo-and-name-result">
                        <div class="profile-avatar-result">
                            <img src="{{ $persona->foto ? asset('storage/' . $persona->foto) : asset('img/perfil.jpg') }}" alt="Foto" style="width:120px; height:120px; object-fit:cover; border-radius:50%;">
                        </div>
                        <div class="profile-main-info-result">
                            <h2 class="profile-name-result">{{ $persona->nombre }} {{ $persona->apellido }}</h2>
                            <span class="badge-familiar" style="color: #007bff; font-weight: bold;">(Familiar Beneficiario)</span>
                        </div>
                    </div>

                    <div class="profile-dates-result">
                        <div class="profile-item">
                            <h3 class="profile-card-title">Datos Familiar</h3>
                            <div class="profile-grid">
                                <div class="profile-field">
                                    <span class="label">Cédula</span>
                                    <span class="value2">{{ $persona->tipo }}-{{ $persona->cedula }}</span>
                                </div>
                                <div class="profile-field">
                                    <span class="label">Parentesco</span>
                                    @if ($relacion->tipo_personal === 'familiar')
                                        <span class="value2" style="color: #d9534f; font-weight: bold;">Padre/Madre</span>
                                    @else
                                    <span class="value2" style="color: #d9534f; font-weight: bold;">{{ strtoupper($relacion->tipo_personal) }}</span>
                                    @endif
                                </div>
                                <div class="profile-field">
                                    <span class="label">Cédula Titular</span>
                                    <span class="value2">{{ $relacion->cedula }}</span>
                                </div>
                               
                            </div>
                        </div>
                        {{-- ... (puedes añadir aquí el bloque de contacto si lo deseas) ... --}}
                        <div class="profile-item">
                            <h3 class="profile-card-title">Contacto</h3>
                            <div class="profile-contact-list">
                                <div class="profile-contact-item2">
                                    <span class="contact-label2">Correo</span>
                                    <div class="contact-value">
                                        <span class="value2">{{ $persona->correo }}</span>
                                    </div>
                                </div>
                                <div class="profile-contact-item2">
                                    <span class="contact-label2">Teléfono</span>
                                    <div class="contact-value">
                                        <span class="value2">{{ $persona->codigo }}{{ $persona->telefono }}</span>
                                    </div>
                                </div>
                                <div class="profile-contact-item2">
                                    <span class="contact-label2">Dirección</span>
                                    <div class="contact-value">
                                        <span class="value2">{{ $persona->direccion }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @php
                    $titular = \App\Models\Persona::where('cedula', $relacion->cedula)->first();
                @endphp
                @if($titular)
                    <div class="profile-header-card-result" style="border-left: 5px solid #28a745;">
                        <div class="profile-photo-and-name-result">
                            <div class="profile-avatar-result">
                                <img src="{{ $titular->foto ? asset('storage/' . $titular->foto) : asset('img/perfil.jpg') }}" alt="Foto" style="width:100px; height:100px; object-fit:cover; border-radius:50%;">
                            </div>
                            <div class="profile-main-info-result">
                                <h2 class="profile-name-result">{{ $titular->nombre }} {{ $titular->apellido }}</h2>
                                <span class="badge-titular" style="color: #28a745; font-weight: bold;">(Titular Responsable)</span>
                            </div>
                        </div>
                        <div class="profile-dates-result">
                            <div class="profile-item">
                                <h3 class="profile-card-title">Datos del Titular</h3>
                                <div class="profile-grid">
                                    <div class="profile-field">
                                        <span class="label">Cédula</span>
                                        <span class="value2">{{ $titular->tipo }}-{{ $titular->cedula }}</span>
                                    </div>
                                   
                                    <div class="profile-field">
                                        <span class="label">Estado Civil</span>
                                        <span class="value2">{{ $titular->estado_civil }}</span>  
                                    </div>
                                </div>
                            </div>
                            <div class="profile-item">
                            <h3 class="profile-card-title">Contacto</h3>
                            <div class="profile-contact-list">
                                <div class="profile-contact-item2">
                                    <span class="contact-label2">Correo</span>
                                    <div class="contact-value">
                                        <span class="value2">{{ $titular->correo }}</span>
                                    </div>
                                </div>
                                <div class="profile-contact-item2">
                                    <span class="contact-label2">Teléfono</span>
                                    <div class="contact-value">
                                        <span class="value2">{{ $titular->codigo }}{{ $titular->telefono }}</span>
                                    </div>
                                </div>
                                <div class="profile-contact-item2">
                                    <span class="contact-label2">Dirección</span>
                                    <div class="contact-value">
                                        <span class="value2">{{ $titular->direccion }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                @endif

            @else
                {{-- --- CASO B: CONSULTA NORMAL (Persona no es familiar de nadie) --- --}}
                <div class="profile-header-card-result">
                    <div class="profile-photo-and-name-result">
                        <div class="profile-avatar-result">
                            <img src="{{ $persona->foto ? asset('storage/' . $persona->foto) : asset('img/perfil.jpg') }}" alt="Foto" style="width:120px; height:120px; object-fit:cover; border-radius:50%;">
                        </div>
                        <div class="profile-main-info-result">
                            <h2 class="profile-name-result">{{ $persona->nombre }} {{ $persona->nombre2 }}</h2>
                            <h2 class="profile-name-result">{{ $persona->apellido }} {{ $persona->apellido2 }}</h2>
                        </div>
                    </div>
                    <div class="profile-dates-result">
                        <div class="profile-item">
                            <h3 class="profile-card-title">Datos personales</h3>
                            <div class="profile-grid">
                                <div class="profile-field">
                                    <span class="label">Cédula</span>
                                    <span class="value2">{{ $persona->tipo }}-{{ $persona->cedula }}</span>
                                </div>
                                
                                <div class="profile-field">
                                    <span class="label">Estado Civil</span>
                                    <span class="value2">{{ $persona->estado_civil }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="profile-item">
                            <h3 class="profile-card-title">Contacto</h3>
                            <div class="profile-contact-list">
                                <div class="profile-contact-item2">
                                    <span class="contact-label2">Correo</span>
                                    <div class="contact-value">
                                        <span class="value2">{{ $persona->correo }}</span>
                                    </div>
                                </div>
                                <div class="profile-contact-item2">
                                    <span class="contact-label2">Teléfono</span>
                                    <div class="contact-value">
                                        <span class="value2">{{ $persona->codigo }}{{ $persona->telefono }}</span>
                                    </div>
                                </div>
                                <div class="profile-contact-item2">
                                    <span class="contact-label2">Dirección</span>
                                    <div class="contact-value">
                                        <span class="value2">{{ $persona->direccion }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

    {{-- botones
     --}}
    </section>
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
        <div class="container-services__img">
          <img src="img/psquitria.jpg"
               alt="psiquiatría"
               class="container-services_img-psychiatry"
               onerror="this.style.display='none'"/>
        </div>
      </section>
      @endif
      <section class="container-services__calendario">
        <div class="container-services__img">
          <img src="img/calendario.png"
               alt="calendario"
               class="container-services__img-general-medicine"
               onerror="this.style.display='none'"/>
        </div>
      </section>
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