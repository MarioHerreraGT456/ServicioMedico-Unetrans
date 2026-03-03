@extends('layouts.app')

@section('content')
    
    <h2 class="title-form">Registro Médico</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form id="formRegistroMedico" method="POST" action="{{ route('envio.correo2') }}" enctype="multipart/form-data">
      @csrf
      
        <div class="campo">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            @error('nombre')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>


      <div class="campo">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="{{ old('apellido') }}" required>
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
            <input type="tel" id="telefono" name="telefono" value="{{ old('telefono') }}"
                   placeholder="04141234567 o +584141234567"
                   pattern="^(\+58|0)(414|424|412|422|416|426)[0-9]{7}$"
                   title="Formato válido: +584121234567 o 014121234567" required>
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

        <div class="campo">
            <label for="edad">Edad:</label>
            <input type="number" id="edad" name="edad" value="{{ old('edad') }}" required>
            @error('edad')
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

        <div class="campo">
            <label for="cargo">Cargo:</label>
            <select id="cargo" name="cargo" required>
                <option value="medico" {{ old('cargo') == 'medico' ? 'selected' : '' }}>Médico</option>
                <option value="asistente" {{ old('cargo') == 'asistente' ? 'selected' : '' }}>Asistente</option>
            </select>
            @error('cargo')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

         <div class="campo">
            <label for="especialidad">Especialidad:</label>
            <select id="especialidad" name="especialidad" required>
                <option value="medicina general" {{ old('especialidad') == 'medicina general' ? 'selected' : '' }}>Medicina General</option>
                <option value="odontologia" {{ old('especialidad') == 'odontologia' ? 'selected' : '' }}>Odontología</option>
                <option value="psiquiatria" {{ old('especialidad') == 'psiquiatria' ? 'selected' : '' }}>Psiquiatría</option>    
            </select>
            @error('especialidad')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

        {{-- <div class="campo">
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
        </div> --}}

        <div class="hidden">
            <label for="rol" class="hidden">Rol:</label>
            <input type="hidden" name="rol" value="medico">
        </div>
        
      {{-- <div id="registroPacienteMsg" class="form-msg oai-hidden"></div> --}}
      <div class="campo">
        <button type="submit" id="btnRegistroContinuar">Registrar</button>

      </div>


    </form>
    <script src="js/app.js" defer></script>
    @endsection