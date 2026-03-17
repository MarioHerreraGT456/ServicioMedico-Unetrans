@extends('layouts.app')

@section('content')
    
    <h2 class="title-form">Registro</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form id="formRegistroPaciente" method="POST" enctype="multipart/form-data">
      @csrf
      
        <div class="campo">
            <label for="nombre">Primer Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            @error('nombre')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>
        <div class="campo">
            <label for="nombre2">Segundo Nombre:</label>
            <input type="text" id="nombre2" name="nombre2" value="{{ old('nombre2') }}" required>
            @error('nombre')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>


      <div class="campo">
            <label for="apellido">Primer Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="{{ old('apellido') }}" required>
            @error('apellido')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>
        
      <div class="campo">
            <label for="apellido2">Segundo Apellido:</label>
            <input type="text" id="apellido2" name="apellido2" value="{{ old('apellido2') }}" required>
            @error('apellido')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>
      
       <div class="campo">
            <label for="cedula">Cédula:</label>
            <div id="campoCedula">
                <label for="tipo" class="hidden">Tipo:</label>
                <select name="tipo" id="tipo">
                    <option value="V">V</option>
                    <option value="E">E</option>
                </select>
                <input type="text" id="cedula" name="cedula" value="{{ old('cedula') }}"
                       title="Formato válido: V12345678, E12345678" placeholder="12345678" required>
            </div>
            @error('cedula')
                <span class="error-message">Dato inválido</span>
            @enderror
           
        </div>


       <div class="campo">
        
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}" required>
            @error('direccion')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

        <div class="campo">
            <label for="telefono">Teléfono:</label>
              <div id="campoCedula">
                <label for="codigo" class="hidden">Codigo:</label>
                <select name="codigo" id="codigo">
                    <option value="0414">0414</option>
                    <option value="0424">0424</option>
                    <option value="0412">0412</option>
                    <option value="0416">0416</option>
                    <option value="0426">0426</option>
                </select>
             <input type="tel" id="telefono" name="telefono" value="{{ old('telefono') }}"
                   placeholder="1234567"
                   
                    required>
                 </div>
                   @error('telefono')
                       <span class="error-message">Dato inválido</span>
                   @enderror
        </div>

     <div class="campo">
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" value="{{ old('correo') }}" required>
            @error('correo')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

        <div class="campo">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
            @error('fecha_nacimiento')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>


      <!--SEXO-->
       <div class="campo">
            <label for="sexo">Sexo:</label>
            <select id="sexo" name="sexo" required>
                <option value="masculino" {{ old('sexo') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="femenino" {{ old('sexo') == 'femenino' ? 'selected' : '' }}>Femenino</option>
            </select>
            @error('sexo')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

        <!-- ESTADO CIVIL -->
        <div class="campo">
            <label for="selectEstadoCivil">Estado Civil:</label>
            <select id="selectEstadoCivil" name="estado_civil" required>
                <option value="Soltero(a)" {{ old('estado_civil') == 'Soltero(a)' ? 'selected' : '' }}>Soltero(a)</option>
                <option value="Casado(a)" {{ old('estado_civil') == 'Casado(a)' ? 'selected' : '' }}>Casado(a)</option>
                <option value="Divorciado(a)" {{ old('estado_civil') == 'Divorciado(a)' ? 'selected' : '' }}>Divorciado(a)</option>
                <option value="Viudo(a)" {{ old('estado_civil') == 'Viudo(a)' ? 'selected' : '' }}>Viudo(a)</option>
            </select>
            @error('estado_civil')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

        <!-- TIPO DE PACIENTE -->
        <div class="campo">
            <label for="categoria">Tipo de Paciente:</label>
            <select id="categoria" name="categoria" required>
                <option value="estudiante" {{ old('categoria') == 'estudiante' ? 'selected' : '' }}>Estudiante</option>
                <option value="personal" {{ old('categoria') == 'personal' ? 'selected' : '' }}>Personal</option>
            </select>
            @error('categoria')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

      <!-- CARRERAS (solo si es estudiante) -->
      {{-- <div class="campo">
        <label for="selectCarrera" class="hidden">PNF:</label>
        <select id="selectCarrera" name="carrera" class="select-placeholder hidden" required>
          <option value="informatica">PNF en Informática</option>
          <option value="electronica">PNF en Electrónica</option>
          <option value="quimica">PNF en Química</option>
          <option value="procesos_quimicos">PNF en Procesos Químicos</option>
          <option value="mecanica">PNF en Mecánica Automotriz</option>
          <option value="mecanica_industrial">PNF en Mecánica Industrial</option>
          <option value="materiales">PNF en Materiales</option>
          <option value="materiales">PNF en Calidad de Ambiente</option>
        </select>
      </div> --}}
      <!-- TIPO DE PERSONAL -->
      <div class="campo" id="container_tipo_paciente" >
        <label for="tipo_paciente" >Tipo de Personal:</label>
        <select id="tipo_paciente" name="tipo_paciente" class="select-placeholder ">
          <option value="administrativo" {{ old('tipo_paciente') == 'administrativo' ? 'selected' : '' }}>Administrativo</option>
          <option value="docente" {{ old('tipo_paciente') == 'docente' ? 'selected' : '' }}>Docente</option>
          <option value="obrero" {{ old('tipo_paciente') == 'obrero' ? 'selected' : '' }}>Obrero</option>
        </select>
        @error('tipo_paciente')
                <span class="error-message">Dato inválido</span>
            @enderror
      </div>
      <div class="campo" id="container_carrera" >
        <label for="carrera" >Carrera:</label>
        <select id="carrera" name="carrera" class="select-placeholder ">
          <option value="administracion" {{ old('carrera') == 'administracion' ? 'selected' : '' }}>PNF en Administración</option>
          <option value="contaduria" {{ old('carrera') == 'contaduria' ? 'selected' : '' }}>PNF en Contaduría</option>
          <option value="civil" {{ old('carrera') == 'civil' ? 'selected' : '' }}>PNF en Construcción Civil</option>
          <option value="electricidad" {{ old('carrera') == 'electricidad' ? 'selected' : '' }}>PNF en Electricidad</option>
          <option value="electronica" {{ old('carrera') == 'electronica' ? 'selected' : '' }}>PNF en Electrónica</option>
          <option value="instrumentos" {{ old('carrera') == 'instrumentos' ? 'selected' : '' }}>PNF en Instrumentos y Control</option>
          <option value="informatica" {{ old('carrera') == 'informatica' ? 'selected' : '' }}>PNF en Informática</option>
          <option value="industrial" {{ old('carrera') == 'industrial' ? 'selected' : '' }}>PNF en Mecánica Industrial</option>
          <option value="automotriz" {{ old('carrera') == 'automotriz' ? 'selected' : '' }}>PNF en Mecánica Automotriz</option>
          <option value="pq" {{ old('carrera') == 'pq' ? 'selected' : '' }}>PNF en Procesos Químicos</option>
          <option value="calidad" {{ old('carrera') == 'calidad' ? 'selected' : '' }}>PNF en Sist. de Calidad y Ambiente</option>
          <option value="quimica" {{ old('carrera') == 'quimica' ? 'selected' : '' }}>PNF en Química</option>
          <option value="materiales" {{ old('carrera') == 'materiales' ? 'selected' : '' }}>PNF en Materiales Industriales</option>
        </select>
        @error('tipo_paciente')
                <span class="error-message">Dato inválido</span>
            @enderror
      </div>
<!--{{-- 
      <div class="campo">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

        <div class="campo">
            <label for="password_confirmation">Confirme contraseña:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
            @error('password_confirmation')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div> --}} -->

        <div class="hidden">
            <label for="rol" class="hidden">Rol:</label>
            <input type="hidden" name="rol" value="paciente">
        </div>
        
      {{-- <div id="registroPacienteMsg" class="form-msg oai-hidden"></div> --}}
      <div class="campo">
        <button type="submit" id="btnRegistroContinuar">Registrar</button>

      </div>


    </form>
    
    <script>
    window.envioCorreoUrl = "{{ route('envio.correo') }}";
    window.csrfToken = "{{ csrf_token() }}";
    </script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('js/register.js') }}"></script>
  <script src="{{ asset('js/correoRegister.js') }}"></script>
  
    @endsection
